<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepository;

class BaseController extends Controller
{
    protected $CategoryRepository;

    public function __construct(CategoryRepository $CategoryRepository)
    {
        $this->CategoryRepository = $CategoryRepository;
        view()->share('categoryMaster',  $this->CategoryRepository->getCategory());
    }
}
