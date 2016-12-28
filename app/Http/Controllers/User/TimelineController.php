<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\TimelineInterface;
use App\Repositories\Interfaces\FollowInterface;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\UserInterface;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\BaseController;

class TimelineController extends BaseController
{
    protected $timeline;
    protected $follow;
    protected $user;

    public function __construct(TimelineInterface $timeline, FollowInterface $follow, UserInterface $user)
    {
        parent::__construct();
        $this->middleware('user');
        $this->timeline = $timeline;
        $this->follow = $follow;
        $this->user = $user;
    }

    public function getTimeline()
    {
        $user = $this->user->getProfile(Auth::user()->id);
        $data = $this->timeline->getTimeline(Auth::user()->id, Auth::user()->id);
        $activities = $this->timeline->getActivity(Auth::user()->id);
        $followActivities = $this->timeline->getActivityFollow(Auth::user()->id, Auth::user()->id);

        return view('user.pages.home', compact('data', 'user', 'activities', 'followActivities'));
    }

    public function postUnFollow($id)
    {
        if (\Request::ajax()) {
            $followedId = \Request::get('id');
            $actionId = $this->follow->getRow(Auth::user()->id, $followedId);

            if ($this->timeline->deleteAction(Auth::user()->id, trans('message.follow'), $actionId->id) &&
                    $this->follow->unFollow(Auth::user()->id, $followedId)
                ) {

                return trans('message.success');
            } else {
                return trans('message.fail');
            }
        }
    }

    public function getTimelineUser($id)
    {
        $user = $this->user->getProfile($id);
        $data = $this->timeline->getTimeline($id, Auth::user()->id);
        $activities = $this->timeline->getActivity($id);
        $followActivities = $this->timeline->getActivityFollow(Auth::user()->id, Auth::user()->id);

        return view('user.pages.home',compact('data', 'user', 'activities', 'followActivities'));
    }
}
