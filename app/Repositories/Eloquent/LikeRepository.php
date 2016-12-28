<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\LikeInterface;
use App\Repositories\Interfaces\CommentInterface;
use App\Repositories\Interfaces\ReviewInterface;
use App\Models\Like;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\FavoriteInterface;

class LikeRepository extends BaseRepository implements LikeInterface
{
    protected $comments;
    protected $reviews;
    protected $favorites;

    public function __construct(
        Like $like,
        CommentInterface $commentInterface,
        ReviewInterface $reviewInterface,
        FavoriteInterface $favoriteInterface
    ) {
        $this->model = $like;
        $this->comments = $commentInterface;
        $this->reviews = $reviewInterface;
        $this->favorites = $favoriteInterface;
    }

    public function delLike($type, $tagert_id, $userId)
    {
        $this->model->where('user_id', $userId)->where('target_type', $type)->where('target_id', $tagert_id)->delete();
    }

    public function check($userId, $bookId, $table)
    {
        $type = $table;
        $like = $this->$type->getBy($userId, $bookId);

        if ($like) {
            return true;
        }

        return false;
    }

    public function getContent($id)
    {
        $like = $this->model->find($id);

        if ($like->target_type == 'likeReview') {
            $book = $this->reviewInterface->getReview($like->target_id);

            return $book[0]->book;
        }

        $review = $this->commentInterface->getComment($like->target_id);

        return  $review[0]->review->book;
    }
}
