<?php

namespace App\Repositories\Author;

use App\Models\Author;
use App\Repositories\BaseRepository;

class AuthorRepository extends BaseRepository
{
    public function __construct(Author $author)
    {
        $this->model = $author;
    }

    public function getListAuthor()
    {
        $list_authors = $this->model->lists('name');

        return $list_authors;
    }
}
