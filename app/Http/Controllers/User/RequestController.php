<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Eloquent\RequestRepository;
use App\Http\Requests\RequestRequest;

class RequestController extends BaseController
{
    protected $requestRepository;

    public function __construct(RequestRepository $requestRepository)
    {
        $this->requestRepository = $requestRepository;
        parent::__construct();
    }

    public function index()
    {
        $requests = $this->requestRepository->getAllOfRequest(Auth::user()->id);

        return view('user.pages.request', compact('requests'));
    }

    public function destroy($requestId)
    {
        if ($this->requestRepository->delete($requestId)) {
            return redirect()->action('User\RequestController@index')->with('success', trans('book_request.cancel_success'));
        }

        return redirect()->action('User\RequestController@index')->with('fails', trans('book_request.cancel_fail'));
    }

    public function store(RequestRequest $request)
    {
        $inputs = [
            'content' => $request->content,
            'status' => 1,
            'user_id' => Auth::user()->id,
        ];

        if ($this->requestRepository->create($inputs)) {
            return redirect()->action('User\RequestController@index')->with('success', trans('book_request.send_success'));
        }

        return redirect()->action('User\RequestController@index')->with('fails', trans('book_request.send_fail'));
    }
}
