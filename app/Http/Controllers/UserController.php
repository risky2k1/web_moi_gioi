<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as ViewShare;
use JetBrains\PhpStorm\NoReturn;

class UserController extends Controller
{
    private object $model;
    private string $table;

    #[NoReturn] public function __construct()
    {
        $this->model = User::query();
        $this->table = (new User())->getTable();
        $title = ucfirst($this->table);
        ViewShare::share('title',$title);
    }

    public function index(): Factory|View|Application
    {
        $data = $this->model->paginate(10);

        return view('admin'.'.'.$this->table.'.'.'index',[
            'data'=>$data,
        ]);
    }
}
