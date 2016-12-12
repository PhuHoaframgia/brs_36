<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface BookInterface
{
    public function getAllOfBook($CategoryId);
    public function getDetailBook($bookId);
}
