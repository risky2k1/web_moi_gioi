<?php

namespace App\Http\Controllers;

use App\Models\Post;
use JetBrains\PhpStorm\NoReturn;

class PostApiController extends Controller
{
    private object $model;

    #[NoReturn] public function __construct()
    {
        $this->model = Post::query();
    }
    public function index()
    {
        return $this->model->paginate();
    }
}
