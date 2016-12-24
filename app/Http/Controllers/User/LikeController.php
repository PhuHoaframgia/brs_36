<?php

namespace App\Http\Controllers\User;

use Request;
use App\Repositories\Interfaces\TimelineInterface;
use App\Repositories\Interfaces\LikeInterface;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    protected $likeInterface;
    protected $timelineInterface;

    public function __construct(LikeInterface $likeInterface, TimelineInterface $timelineInterface) 
    {
        $this->likeInterface = $likeInterface;
        $this->timelineInterface = $timelineInterface;
    }

    public function markLike()
    {
        if (Request::ajax()) {
            $type = Request::get('type');
            $idBook = (int) Request::get('idBook');
            $temp = Request::get('temp');

            if ($temp == 'Mark favorite') {
                $inputs = [
                    'target_type' => $type,
                    'target_id' => $idBook,
                    'user_id' => Auth::user()->id,
                ];
                $this->timelineInterface->insertAction($inputs);   
                $this->likeInterface->create($inputs);

                return 1;
            } else {
                $this->likeInterface->delLike($type, $idBook, Auth::user()->id);
                $this->timelineInterface->deleteAction(Auth::user()->id, $type, $idBook);

                return 2;
            }
        }
    }
}
