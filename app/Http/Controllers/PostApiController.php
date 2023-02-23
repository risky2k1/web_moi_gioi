<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use JetBrains\PhpStorm\NoReturn;

class PostApiController extends Controller
{
    private object $model;

    #[NoReturn] public function __construct()
    {
        $this->model = Post::query();
    }
    public function index(): JsonResponse
    {
        $data=  $this->model->paginate();

        foreach ($data as $each){
            $each->currency_salary=$each->currency_salary_code;
            $each->status=$each->status_name;
        }

        return response()->json([
            'success'    => true,
            'data'       => $data->getCollection(),
            'pagination' => $data->linkCollection()
        ]);
    }
}
