<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\MarkInterface;
use App\Models\Mark;
use App\Repositories\BaseRepository;

class MarkRepository extends BaseRepository implements MarkInterface
{

    public function __construct(Mark $mark)
    {
        $this->model = $mark;
    }

    public function findMark($book_id, $userId)
    {
        return $this->model->where('user_id', $userId)->where('book_id', $book_id)->first();
    }

    public function check($bookId, $userId)
    {
        $checkMark = $this->model->where('book_id', $bookId)->where('user_id', $userId)->first();

        if ($checkMark) {
            return $checkMark->status;
        }
    
        return false;
    }

    public function getContent($id)
    {
        return $this->find($id)->book;
    }
}