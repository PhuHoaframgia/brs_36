<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface MarkInterface
{
    public function findMark($book_id, $userId);
    public function check($bookId, $userId);
    public function getContent($id);
}
