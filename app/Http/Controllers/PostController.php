<?php

namespace App\Http\Controllers;

use App\Imports\PostsImport;
use App\Models\Company;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as ViewShare;
use JetBrains\PhpStorm\NoReturn;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{
    private object $model;
    private string $table;

    #[NoReturn] public function __construct()
    {
        $this->model = Post::query();
        $this->table = (new Post())->getTable();
        $title = ucfirst($this->table);
        $table = $this->table;
        ViewShare::share('title', $title);
        ViewShare::share('table', $table);
    }
    public function index()
    {
//        return $this->model->paginate();
        return \view('admin.posts.index');
    }

    public function create()
    {
        $companies = Company::query()->get();

        return \view('admin.posts.create',[
            'companies'=>$companies,
        ]);
    }

    public function importCsv(Request $request)
    {
        Excel::import(new PostsImport(), $request->file('file'));
    }
}
