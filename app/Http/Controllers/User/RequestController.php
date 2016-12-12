<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Eloquent\RequestRepository;
use App\Http\Requests\RequestRequest;
use App\Repositories\Category\CategoryRepository;

class RequestController extends BaseController
{
    protected $requestRepository;

    public function __construct(RequestRepository $requestRepository,CategoryRepository $CategoryRepository)
    {
        $this->requestRepository = $requestRepository;
        parent::__construct($CategoryRepository);
    }

    public function getAllRequest()
    {
        $count = $this->requestRepository->getAllOfRequest(Auth::user()->id)->count();
        $requests = [];

        if ($count) {
            $requests = $this->requestRepository->getAllOfRequest(Auth::user()->id);
        }

        return view('user.pages.request', compact('requests'));
    }

    public function destroy($requestId)
    {
        if ($this->requestRepository->delete($requestId)) {
            return redirect()->action('User\RequestController@getAllRequest')->with('success', trans('book_request.cancel_success'));
        }

        return redirect()->action('User\RequestController@getAllRequest')->with('fails', trans('book_request.cancel_fail'));
    }

    public function store(RequestRequest $request)
    {
        $inputs = [
            'content' => $request->content,
            'status' => 1,
            'user_id' => Auth::user()->id,
        ];

        if ($this->requestRepository->create($inputs)) {
            return redirect()->action('User\RequestController@getAllRequest')->with('success', trans('book_request.send_success'));
        }

        return redirect()->action('User\RequestController@getAllRequest')->with('fails', trans('book_request.send_fail'));
    }
}
