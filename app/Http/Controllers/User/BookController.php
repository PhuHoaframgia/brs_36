<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Repositories\Interfaces\BookInterface;
use App\Repositories\Interfaces\MarkInterface;
use App\Repositories\Interfaces\LikeInterface;
use Illuminate\Support\Facades\Auth;

class BookController extends BaseController
{
    protected $bookInterface;
    protected $likeInterface;
    protected $markInterface;

    public function __construct(BookInterface $bookInterface, LikeInterface $likeInterface, MarkInterface $markInterface)
    {
        $this->bookInterface = $bookInterface;
        parent::__construct();
        $this->likeInterface = $likeInterface;
        $this->markInterface = $markInterface;
    }

    public function show($categoryId)
    {
        $books = $this->bookInterface->getAllOfBook($categoryId);

        return view('user.pages.list', compact('books', 'categoryId'));
    }

    public function getDetail($bookId)
    {
        $book = $this->bookInterface->getDetailBook($bookId);
        $data = [
            'book' => $book,
            'haveLike' => $this->likeInterface->check(Auth::user()->id, $bookId),
            'markbook' => $this->markInterface->check($bookId ,Auth::user()->id),
        ];

        if (!$book) {
            return view('user.pages.detail_book')->with('fails', trans('book.dont_have_this_category'));
        }

        return view('user.pages.detail_book', compact('data'));
    }
}