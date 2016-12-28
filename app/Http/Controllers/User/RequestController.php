<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\RequestInterface;
use App\Http\Requests\RequestRequest;
use App\Repositories\Interfaces\TimelineInterface;

class RequestController extends BaseController
{

    protected $requestInterface;
    protected $timeline;

    public function __construct(RequestInterface $requestInterface, TimelineInterface $timeline)
    {
        parent::__construct();
        $this->requestInterface = $requestInterface;
        $this->timeline = $timeline;
    }

    public function index()
    {
        $requests = $this->requestInterface->getAllOfRequest(Auth::user()->id);
        $followActivities = $this->timeline->getActivityFollow(Auth::user()->id, Auth::user()->id);

        return view('user.pages.request', compact('requests', 'followActivities'));
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
