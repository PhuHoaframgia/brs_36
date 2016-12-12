<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepository;

class BaseController extends Controller
{
    protected $CategoryRepository;

    public function __construct()
    {
        $this->CategoryRepository = $this->categoryRepository = \App::make('App\Repositories\Category\CategoryRepository');;
        view()->share('categoryMaster',  $this->CategoryRepository->getCategory());
    }
}
