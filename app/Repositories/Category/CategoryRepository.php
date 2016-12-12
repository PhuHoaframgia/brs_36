<?php
namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository
{
    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getListCategory()
    {
        $categories = $this->model->lists('name');

        return $categories;
    }
    public function getCategory()
    {
        $categories = $this->model->all();

        return $categories;
    }
}
