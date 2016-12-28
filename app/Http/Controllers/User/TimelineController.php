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
    protected $followUser;
    protected $user;

    public function __construct(TimelineInterface $timeline, FollowInterface $follow, UserInterface $user)
    {
        parent::__construct();
        $this->middleware('user');
        $this->timeline = $timeline;
        $this->followUser = $follow;
        $this->user = $user;
    }

    public function getTimeline()
    {
        $user = $this->user->getProfile(Auth::user()->id);
        $data = $this->timeline->getTimeline(Auth::user()->id, Auth::user()->id);
        $activities = $this->timeline->getActivity(Auth::user()->id);
        $followActivities = $this->timeline->getActivityFollow(Auth::user()->id, Auth::user()->id);
        $status = true;

        return view('user.pages.home', compact('data', 'user', 'activities', 'followActivities', 'status'));
    }

    public function postFollow($id)
    {
        if (\Request::ajax()) {
            $id = \Request::get('id');
            $follow = $this->followUser->follow(Auth::user()->id, $id);
            $action = $this->timeline->insertAction([
                'user_id' => Auth::user()->id,
                'target_type' => trans('message.follow'),
                'target_id' => $follow->id,
            ]);

            if ($follow && $action) {
                return config('settings.result.success');
            }

            $this->followUser->unfollow(Auth::user()->id, $id);

            return config('settings.result.fail');
        }

    }

    public function postUnFollow($id)
    {
        if (\Request::ajax()) {
            $followedId = \Request::get('id');
            $actionId = $this->followUser->getRow(Auth::user()->id, $followedId);

            if ($this->timeline->deleteAction(Auth::user()->id, trans('message.follow'), $actionId->id) &&
                    $this->followUser->unfollow(Auth::user()->id, $followedId)
                ) {

                return config('settings.result.success');
            }

            return config('settings.result.fail');
        }
    }

    public function getTimelineUser($id)
    {
        $user = $this->user->getProfile($id);
        $data = $this->timeline->getTimeline($id, Auth::user()->id);
        $activities = $this->timeline->getActivity($id);
        $followActivities = $this->timeline->getActivityFollow(Auth::user()->id, Auth::user()->id);
        $status = $this->check($id, Auth::user()->id);

        return view('user.pages.home',compact('data', 'user', 'activities', 'followActivities', 'status'));
    }

    public function check($userId, $currentId)
    {
        $status = $this->followUser->getRow($currentId, $userId);

        if ($status) {
            return true;
        }

        return false;
    }
}
