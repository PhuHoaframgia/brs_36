<?php

namespace App\Http\Controllers\User;

use Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ReviewInterface;
use App\Repositories\Interfaces\TimelineInterface;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    protected $reviewInterface;
    protected $timelineInterface;

    public function __construct(
        ReviewInterface $reviewInterface,
        TimelineInterface $timelineInterface
    ) {
        $this->reviewInterface = $reviewInterface;
        $this->timelineInterface = $timelineInterface;
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
            $review = $this->reviewInterface->find($reviewId);
            $comments = $review->comments()->get(['id'])->pluck(['id']);

            if ($this->reviewInterface->deleteReview($reviewId) && 
                $this->timelineInterface->deleteAction(Auth::user()->id, config('settings.reviews'), $reviewId)) {
                $this->timelineInterface->getModel()
                    ->where('target_type', config('settings.comments'))
                    ->whereIn('target_id', $comments)
                    ->delete();

                return ['success' => true];
            } else {
                return ['success' => false];
            }
        }  
    }

    public function update($reviewId) 
    {
        if (Request::ajax()) {
            $content = Request::get('data');
            $inputs = [ 'content' => $content ];

            if ($this->reviewInterface->update($inputs, $reviewId)) {
                return ['success' => true];
            } else {
                return ['success' => false];
            }
        }
    } 
}
