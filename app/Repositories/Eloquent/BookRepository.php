<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\BookInterface;
use App\Models\Book;
use App\Repositories\BaseRepository;

class BookRepository extends BaseRepository implements BookInterface
{
    protected $model;

    public function __construct(Book $book)
    {
        $this->model = $book;
    }

    public function getAllOfBook($categoryId)
    {
        return $this->model->where('category_id', $categoryId)->paginate(9);
    }

    public function getDetailBook($bookId)
    {
        $detail = $this->find($bookId);

        return $detail;
    }
}
