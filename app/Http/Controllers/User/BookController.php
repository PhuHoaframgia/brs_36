<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Repositories\Interfaces\BookInterface;
use App\Repositories\Interfaces\MarkInterface;
use App\Repositories\Interfaces\LikeInterface;
use App\Repositories\Interfaces\RateInterface;
use App\Repositories\Interfaces\TimelineInterface;
use Illuminate\Support\Facades\Auth;

class BookController extends BaseController
{
    protected $bookInterface;
    protected $likeInterface;
    protected $markInterface;
    protected $rateInterface;
    protected $timelineInterface;

    public function __construct(
        BookInterface $bookInterface,
        LikeInterface $likeInterface,
        MarkInterface $markInterface,
        RateInterface $rateInterface,
        TimelineInterface $timelineInterface
    ) {
        parent::__construct();
        $this->bookInterface = $bookInterface;
        $this->likeInterface = $likeInterface;
        $this->markInterface = $markInterface;
        $this->rateInterface = $rateInterface;
        $this->timelineInterface = $timelineInterface;
    }

    public function show($categoryId)
    {
        $books = $this->bookInterface->getAllOfBook($categoryId);
        $followActivities = $this->timelineInterface->getActivityFollow(Auth::user()->id, Auth::user()->id);

        return view('user.pages.list', compact('books', 'categoryId', 'followActivities'));
    }

    public function getDetail($bookId)
    {
        $book = $this->bookInterface->getDetailBook($bookId);
        $followActivities = $this->timelineInterface->getActivityFollow(Auth::user()->id, Auth::user()->id);
        $data = [
            'book' => $book,
            'haveLike' => $this->likeInterface->check(Auth::user()->id, $bookId, 'favorites'),
            'markbook' => $this->markInterface->check($bookId, Auth::user()->id),
            'rateBook' => $this->rateInterface->check($bookId, Auth::user()->id),
        ];

        if (!$book) {
            return view('user.pages.detail_book')->with('fails', trans('book.dont_have_this_category'));
        }

        return view('user.pages.detail_book', compact('data', 'followActivities'));
    }
}
