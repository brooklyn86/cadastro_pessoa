<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\People;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $totalPessoas = People::count();
        $totalVotos = People::sum('votos');
        $totalUser = User::count();
        return view('users.index', compact('totalPessoas','totalVotos','totalUser'));
    }
    public function getUsers()
    {
        $data = User::latest()->get();
        return Datatables::of($data)
        ->addColumn('action', function($row){
            $actionBtn = '<a href="'.route('user.edit', $row['id']).'" target="_blank" class="edit btn btn-success btn-sm">Editar Pessoa</a> <a href="'.route('user.destroy', $row['id']).'" class="delete btn btn-danger btn-sm">Delete</a>';
            return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    
}
