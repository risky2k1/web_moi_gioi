<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\Company;
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
        $table = $this->table;
        ViewShare::share('title', $title);
        ViewShare::share('table', $table);
    }

    public function index(Request $request): Factory|View|Application
    {
        $selectedRole = $request->get('role');
        $selectedCompany = $request->get('company');
        $roles = UserRoleEnum::asArray();
        $companies = Company::query()
        ->addSelect([
            'id',
            'name',
        ])
        ->get();
//        $data = $this->model //User model
//        ->when($request->has('role'), function ($query) {
//            return $query->where('role', request('role'));
//        })
//            ->with('company:id,name')
//            ->latest()
//            ->paginate(10);

        $query = $this->model->clone() //User model
        ->with('company:id,name')
            ->latest();
        if(!empty($selectedRole) && $selectedRole !== 'All'){
            $query->where('role',$selectedRole);
        }
        if(!empty($selectedCompany) && $selectedCompany !== 'All'){
        $query->whereHas('company',function ($q) use ($selectedCompany) {
            return $q->where('id' ,$selectedCompany);
        });
    }

        $data =$query->paginate();

        return view('admin' . '.' . $this->table . '.' . 'index', [
            'data' => $data,
            'roles' => $roles,
            'companies'=>$companies,
            'selectedRole' => $selectedRole,
            'selectedCompany' => $selectedCompany,
        ]);
    }

    public function show()
    {

    }
    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->back();
    }
}
