<?php

namespace App\Repositories\UserAdmin;

use App\Models\User;
use Input;
use Hash;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function createUser($datas)
    {
        return $this->model->create($data);
    }

    public function getUserWithEmail($providerUser)
    {
        $user = $this->model->findByEmail($providerUser->getEmail())->first();

        return $user;
    }

    public function create($request)
    {
        if (isset($request['image'])) {
            $fileName = $this->uploadAvatar(null);
        } else {
            $fileName =  config('settings.avatar_default');
        }
        
        $user = [
            'name' => $request['name'],
            'email' => $request['email'],
            'image' => $fileName,
            'password' => bcrypt($request['password']),
            'gender' => $request['gender'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'birthday' => $request['birthday'],
        ];
        $createUser = $this->model->create($user);
        if (!$createUser) {
            throw new Exception('message.create_error');
        }

        return $createUser;
    }

    public function update($inputs, $id)
    {
        try {
            $currentUser = $this->model->find($id);
            if (isset($request['password'])) {
                $inputs['password'] = bcrypt($inputs['password']);
            } else {
                $inputs['password'] = $currentUser->password;
            }

            $oldImage = $currentUser->image;
            if (isset($inputs['image'])) {
                $inputs['image'] = $this->uploadAvatar($oldImage);
            } else {
                $inputs['image'] = $oldImage;
            }

            $data = $this->model->where('id', $id)->update($inputs);
        } catch (Exception $e) {
            throw new Exception(trans('user.message.update_fail'));
        }

        return $data;
    }

    public function uploadAvatar($oldImage)
    {
        $file = Input::file('image');
        $destinationPath = base_path() . config('settings.avatar_path');
        $fileName = uniqid(rand(), true) . '.' . $file->getClientOriginalExtension();
        Input::file('image')->move($destinationPath, $fileName);
        if (!empty($oldImage) && file_exists($oldImage)) {
            File::delete($oldImage);
        }

        return $fileName;
    }
}
