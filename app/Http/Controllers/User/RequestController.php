<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\RequestInterface;
use App\Http\Requests\RequestRequest;

class RequestController extends BaseController
{
    protected $requestInterface;

    public function __construct(RequestInterface $requestInterface)
    {
        $this->requestInterface = $requestInterface;
        parent::__construct();
    }

    public function index()
    {
        $requests = $this->requestInterface->getAllOfRequest(Auth::user()->id);

        return view('user.pages.request', compact('requests'));
    }

    public function destroy($requestId)
    {
        if ($this->requestInterface->delete($requestId)) {
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

        if ($this->requestInterface->create($inputs)) {
            return redirect()->action('User\RequestController@index')->with('success', trans('book_request.send_success'));
        }

        return redirect()->action('User\RequestController@index')->with('fails', trans('book_request.send_fail'));
    }
}
