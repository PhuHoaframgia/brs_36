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
    protected $TimelineInterface;

    public function __construct(ReviewInterface $reviewInterface,TimelineInterface $TimelineInterface)
    {
        $this->reviewInterface = $reviewInterface;
        $this->TimelineInterface = $TimelineInterface;
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

                if ($this->TimelineInterface->insertAction($timeline)) {
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
}
