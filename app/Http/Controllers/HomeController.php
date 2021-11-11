<?php

namespace App\Http\Controllers;
use App\Models\People;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        
        $totalPessoas = People::count();
        $totalVotos = People::sum('votos');
        $totalUser = User::count();
        return view('dashboard', compact('totalPessoas', 'totalVotos', 'totalUser'));
    }
}
