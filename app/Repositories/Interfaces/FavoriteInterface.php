<?php

namespace App\Repositories\Interfaces;

interface FavoriteInterface
{
    public function getFavoriteBook($id);
    public function getContent($id);
    public function getBy($userId, $bookId);
    public function removeFavorite($userId, $bookId);
}
