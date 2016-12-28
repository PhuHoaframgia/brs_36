<?php

namespace App\Repositories\Interfaces;

interface FollowInterface
{
    public function getFollow($id, $currentUser);
    public function follow($currentId, $id);
    public function unfollow($currentUser, $id);
    public function getRow($followerId, $followedId);
    public function getContent($id);
}
