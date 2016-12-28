<?php

namespace App\Repositories\Eloquents;

use App\Models\Activity;
use App\Repositories\Interfaces\FavoriteInterface;
use App\Repositories\Interfaces\FollowInterface;
use App\Repositories\Interfaces\UserInterface;
use App\Repositories\Interfaces\TimelineInterface;
use App\Repositories\BaseRepository;
use Exception;
use App\Repositories\Interfaces\BookInterface;
use App\Repositories\Interfaces\CommentInterface;
use App\Repositories\Interfaces\ReviewInterface;
use App\Repositories\Interfaces\RateInterface;
use App\Repositories\Interfaces\LikeInterface;
use App\Repositories\Interfaces\MarkInterface;

class TimelineRepository extends  BaseRepository implements TimelineInterface
{
    protected $users;
    protected $favorites;
    protected $relationships;
    protected $reviews;
    protected $comments;
    protected $rates;
    protected $model;
    protected $likes;
    protected $marks;

    public function __construct(
        UserInterface $userInterface,
        FavoriteInterface $favoriteInterface,
        FollowInterface $relationshipInterface,
        CommentInterface $commentInterface,
        ReviewInterface $reviewInterface,
        RateInterface $rateInterface,
        Activity $activity,
        LikeInterface $likeInterface,
        MarkInterface $markInterface
        ) {
        $this->users = $userInterface;
        $this->favorites = $favoriteInterface;
        $this->relationships = $relationshipInterface;
        $this->reviews = $reviewInterface;
        $this->comments = $commentInterface;
        $this->rates = $rateInterface;
        $this->model = $activity;
        $this->likes = $likeInterface;
        $this->marks = $markInterface;
    }

    public function getTimeline($id, $currentUser)
    {
        $timeline = [
            'favorites' => $this->favorites->getFavoriteBook($id),
            'followed' => $this->relationships->getFollow($id, $currentUser),
        ];

        return $timeline;
    }

    public function getActivity($id)
    {
        $actions = $this->model->where('user_id', $id)->orderBy('id', 'desc')->get();
        $activities = [];
        $data = [];
        foreach ($actions as $action) {
            $type = $action->target_type;
            $data['content'] = $this->$type->getContent($action->target_id);
            $data['title'] = $action->title .
                (($data['content']->name) ? ('user '.$data['content']->name):('book '. $data['content']->tittle)).
                ' at '. $data['content']->created_at;
            $data['user'] = $action->user;
            $data['type'] = $action->target_type;
            $data['actionId'] = $action->id;
            $activities[] = $data;
        }

        return $activities;
    }

    public function insertAction($inputs)
    {
        if ($this->model->create($inputs)) {
             return true;
        }

        return false;
    }

    public function deleteAction($userId, $type, $actionId)
    {
        if ($this->model->where('user_id', $userId)->where('target_type', $type)->where('target_id', $actionId)->delete()) {
            return true;
        }

        return false;
    }

    public function getActivityFollow($id, $currentUser)
    {
        $inputs = $this->relationships->getFollow($id, $currentUser);
        $ids = [];
        foreach ($inputs as $userId) {
            $ids[] = $userId['id'];
        }
        $actions = $this->model->whereIn('user_id', $ids)->orderBy('id', 'desc')->get();
        $activities = [];
        $data = [];
        foreach ($actions as $action) {
            $type = $action->target_type;
            $data['content'] = $this->$type->getContent($action->target_id);
            $data['title'] = $action->title .
                (($data['content']->name) ? ('user '.$data['content']->name):('book '. $data['content']->tittle)).
                ' at '. $data['content']->created_at;
            $data['user'] = $action->user;
            $data['type'] = $action->target_type;
            $data['actionId'] = $action->id;
            $activities[] = $data;
        }

        return $activities;
    }
}
