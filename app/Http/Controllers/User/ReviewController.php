<?php

namespace App\Http\Controllers\User;

use Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ReviewInterface;
use App\Repositories\Interfaces\TimelineInterface;
use App\Repositories\Interfaces\CommentInterface;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    protected $reviewInterface;
    protected $timelineInterface;
    protected $commentInterface;

    public function __construct(ReviewInterface $reviewInterface,TimelineInterface $timelineInterface, CommentInterface $commentInterface)
    {
        $this->reviewInterface = $reviewInterface;
        $this->timelineInterface = $timelineInterface;
        $this->commentInterface = $commentInterface;
    }

    public function store()
    {
        if (Request::ajax()) {
            $data = Request::get('data');
            $idbook = (int) Request::get('idbook');
            $user_name = Auth::user()->name;
            $getReview = [
                'content' => $data,
                'book_id' => $idbook,
                'user_id' => Auth::user()->id,
            ];

            if ($review = $this->reviewInterface->create($getReview)) {
                $timeline = [
                    'target_type' => 'reviews',
                    'target_id' => $review->id,
                    'user_id' => Auth::user()->id,
                ];

                if ($this->timelineInterface->insertAction($timeline)) {
                    return [ 
                        'success' => true, 
                        'data' => view('user.temps.temp_detail', compact('data', 'review'))->render(), 
                    ];
                }

                return ['success' => false];
            } else {

                return ['success' => false];
            }
        }
    }

    public function delete($reviewId)
    {
        if (Request::ajax()) {
            
            if ($this->reviewInterface->deleteReview($reviewId) && $this->timelineInterface->deleteAction(Auth::user()->id, 'reviews', $reviewId)) {
                $comments = $this->commentInterface->selectCondition($reviewId, Auth::user()->id);

                if ($comments) {

                    foreach ($comments as $comment) {
                        $this->timelineInterface->deleteAction(Auth::user()->id, 'comments', $comment->id);
                        $this->commentInterface->deleteComment($comment->id);
                    }
                }

                return [ 'success' => true ];
            } else {

                return [ 'success' => false ];
            }
        }  
    }

    public function update($reviewId) 
    {
        if (Request::ajax()) {
            $content = Request::get('data');
            $inputs = [ 'content' => $content ];

            if ($this->reviewInterface->update($inputs, $reviewId)) {

                return [ 'success' => true ];
            } else {

                return [ 'success' => false ];
            }
        }
    } 
}
