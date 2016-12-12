<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Repositories\Eloquent\BookRepository;
use App\Repositories\Category\CategoryRepository;

class BookController extends BaseController
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository,CategoryRepository $CategoryRepository)
    {
        $this->bookRepository = $bookRepository;
        parent::__construct($CategoryRepository);
    }

    public function getAllBook($categoryId)
    {
        $books = $this->bookRepository->getAllOfBook($categoryId);

        if (!$books) {
            return view('user.pages.list')->with('fails', trans('book.dont_have_this_book'));
        }

        return view('user.pages.list', compact("books"));
    }

    public function getDetail($bookId)
    {
        $book = $this->bookRepository->getDetailBook($bookId);

        if (!$book) {
            return view('user.pages.detail_book')->with('fails', trans('book.dont_have_this_category'));
        }

        return view('user.pages.detail_book', compact("book"));
    }
}
