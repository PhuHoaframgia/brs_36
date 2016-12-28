<?php

namespace App\Http\Controllers\User;

use Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\RateInterface;
use App\Repositories\Interfaces\TimelineInterface;

class RateController extends Controller
{
    protected $rateInterface;
    protected $timelineInterface;
    protected $bookInterface;

    public function __construct(RateInterface $rateInterface, TimelineInterface $timelineInterface)
    {
        $this->rateInterface = $rateInterface;
        $this->timelineInterface = $timelineInterface;
    }

    public function rateBook()
    {
        if(Request::ajax()) {
            $bookId = (int) Request::get('bookId');
            $value = Request::get('value');
            $rate = $this->rateInterface->findRate($bookId, Auth::user()->id);

            if (!$rate) {
                $rates = [
                    'point' => $value,
                    'book_id' => $bookId,
                    'user_id' => Auth::user()->id,
                ];

                if ($getRate = $this->rateInterface->create($rates)) {
                    $timeline = [
                        'target_type' => 'rates',
                        'target_id' => $getRate->id,
                        'user_id' => Auth::user()->id,
                    ];

                    if ($this->timelineInterface->insertAction($timeline)) {
                        return 1;
                    }
                }
            }
            $updateRate = [
                'point' => $value,
            ];
            $this->rateInterface->update($updateRate, $rate->id);
            $this->rateInterface->rateAvg($bookId);

            return 2;
        }
    }
}