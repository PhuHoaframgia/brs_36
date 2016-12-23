<?php

namespace App\Http\Controllers\user;

use Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\TimelineInterface;
use App\Repositories\Interfaces\CommentInterface;

class CommentController extends Controller
{
    protected $commentInterface;

    public function __construct(CommentInterface $commentInterface, TimelineInterface $timelineInterface)
    {
        $this->commentInterface = $commentInterface;
        $this->timelineInterface = $timelineInterface;
    }

    public function store()
    {
        if (Request::ajax()) {
            $data = Request::get('data');
            $reviewId = (int) Request::get('id_review');
            $getComment = [
                'content' => $data,
                'review_id' => $reviewId,
                'user_id' => Auth::user()->id,
            ];
            
            if ($comment = $this->commentInterface->create($getComment)) {
                $timeline = [
                    'target_type' => 'comments',
                    'target_id' => $comment->id,
                    'user_id' => Auth::user()->id,
                ];

                if ($this->timelineInterface->insertAction($timeline)) { 
                   
                    return [
                        'success' => true,
                        'data' => view('user.temps.temp_comment', compact('data', 'comment'))->render(), 
                    ];
                }

                return [ 'success' => false ];
            } else {

                return [ 'success' => false ];
            }
        }
    }
}