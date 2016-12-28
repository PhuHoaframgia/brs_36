<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Repositories\UserAdmin\UserRepository;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends BaseController
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    public function edit ($id)
    {
        $user = $this->userRepository->find($id);

        return view('user.pages.profile', compact('user'));
    }

    public function update (UpdateUserRequest $request, $id)
    {
        $input = $request->only('name', 'email', 'birthday', 'phone', 'address', 'gender', 'image', 'password');
        if ($this->userRepository->update($input, $id)) {
            return redirect()->action('User\TimelineController@getTimeline')
                ->with('success', trans('user.update_user_successfully'));
        }

        return redirect()->action('User\TimelineController@getTimeline')->with('fails', trans('user.update_user_fail'));
    }
}
