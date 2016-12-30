<?php

namespace App\Repositories\Eloquents;

use App\Models\Review;
use App\Repositories\Interfaces\ReviewInterface;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use DB;
use Exception;

class ReviewRepository extends BaseRepository implements ReviewInterface
{
    protected $model;

    public function __construct(Review $review)
    {
        $this->model = $review;
    }

    public function getReview($bookId)
    {
        return $this->findBy('book_id', $bookId);
    }

    public function setReview($userId, $bookId, $content)
    {
        try {
            $review = $this->create([
                'user_id' => $user_id,
                'book_id' => $bookId,
                'content' => $content,
            ]);

            return true;
        } catch (Exception $e) {
            throw new Exception(trans('message.create_error'));

            return false;
        }
    }

    public function editReview($userId, $bookId, $content)
    {
        $review = $this->update(['content' => $content], $bookId);

        if ($review) {
            return true;
        }

        return false;
    }

    public function deleteReview($reviewId)
    {
        DB::beginTransaction();
        try{
            $this->find($reviewId)->likes()->detach();
            $comments = $this->find($reviewId)->comments;
            foreach ($comments as $comment) {
                $comment->likes()->detach();
            }
            $this->find($reviewId)->comments()->delete();
            $this->find($reviewId)->delete();
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollback();

            return false;
        }
    }

    public function getContent($id)
    {
        return $this->find($id)->book;
    }
}
