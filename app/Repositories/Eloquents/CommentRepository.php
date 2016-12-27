<?php

namespace App\Repositories\Eloquents;

use App\Models\Comment;
use App\Repositories\Interfaces\CommentInterface;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

class CommentRepository extends BaseRepository implements CommentInterface
{
    protected $model;

    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }

    public function getComment($reviewId)
    {
        return $this->findBy('review_id', $reviewId);
    }

    public function setComment($userId, $reviewId, $content)
    {
        try {
            $comment = $this->create([
                'user_id' => $userId,
                'review_id' => $reviewId,
                'content' => $content,
            ]);

            return true;
        } catch (Exception $e) {
            throw new Exception(trans('message.create_error'));

            return false;
        }
    }

    public function editComment($userId, $reviewId, $content)
    {
        $comment = $this->update(['content' => $content], $reviewId);

        if ($comment) {
            return true;
        }

        return false;
    }

    public function deleteComment($commentId)
    {
        $comment = $this->delete($commentId);

        if ($comment) {
            return true;
        }

        return false;
    }

    public function getContent($id)
    {
        return $this->find($id)->review;
    }

    public function selectCondition($reviewtId, $userId)
    {
        $comment = $this->model->where('user_id', $userId)->where('review_id', $reviewtId)->get();

        if ($comment) {
            return $comment;
        }

        return false;
    }
}
