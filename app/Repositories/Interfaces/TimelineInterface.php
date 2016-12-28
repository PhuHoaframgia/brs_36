<?php

namespace App\Repositories\Interfaces;

interface TimelineInterface
{
    public function getTimeline($id, $curentUser);
    public function getActivity($id);
    public function insertAction($inpust);
    public function deleteAction($userId, $type, $actionId);
    public function getActivityFollow($id, $currentUser);
}
