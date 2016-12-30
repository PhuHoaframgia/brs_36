<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface LikeInterface
{
    public function delLike($type, $tagert_id, $userId);
    public function check($userId, $id, $type);
    public function getContent($id);
}
