<?php

namespace App\Repositories\Eloquents;

use App\Models\Favorite;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\FavoriteInterface;

class FavoriteRepository extends BaseRepository implements FavoriteInterface
{

    public function __construct(Favorite $favorite)
    {
        $this->model = $favorite;
    }

    public function getFavoriteBook($id)
    {
        $favorites = $this->findBy('user_id', $id);
        $books = [];
        foreach ($favorites as $favorite) {
            $data = [
                'id'=> $favorite->book->id,
                'tittle' => $favorite->book->tittle,
                'rate_avg' => $favorite->book->rate_avg,
                'public_date' => $favorite->book->public_date,
                'image' => $favorite->book->image,
                'author' => $favorite->book->author,
                'time' => $favorite->created_at,
            ];
            $books [] = $data;
        }

        return $books;
    }

    public function getContent($id)
    {
        return $this->find($id)->book;
    }
}
