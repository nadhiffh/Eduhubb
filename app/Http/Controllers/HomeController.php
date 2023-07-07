<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\User;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();
        $classrooms = Classroom::count();

        $widget = [
            'users' => $users,
            'classrooms' => $classrooms,
            //...
        ];

        return view('home', compact('widget'));
    }
}
