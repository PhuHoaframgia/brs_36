<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\RequestInterface;
use App\Models\Request;
use App\Repositories\BaseRepository;

class RequestRepository extends BaseRepository implements RequestInterface
{

    public function __construct(Request $request)
    {
        $this->model = $request;
    }

    public function getAllOfRequest($userId)
    {
        return $this->model->where('user_id', $userId)->get();
    }
}


