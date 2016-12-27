<?php

namespace App\Repositories\Interfaces;

interface CommentInterface
{
    public function getComment($reviewId);
    public function setComment($userId, $reviewId, $content);
    public function editComment($userId, $reviewId, $content);
    public function deleteComment($commentId);
    public function getContent($id);
    public function selectCondition($reviewtId, $userId);
}
