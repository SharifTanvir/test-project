<?php

namespace App\Http\Controllers;

use App\Likes;
use App\User;
use Illuminate\Support\Facades\DB;
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
        $current_user = User::where('id', '=', auth()->id())
            ->first();

        $users = User::select('id' ,'name', 'gender', 'birth_date', 'latitude', 'longitude', 'image', DB::raw(sprintf(
                '(6371 * acos(cos(radians(%1$.7f)) * cos(radians(latitude)) * cos(radians(longitude) - radians(%2$.7f)) + sin(radians(%1$.7f)) * sin(radians(latitude)))) AS distance',
            $current_user->latitude,
            $current_user->longitude
            )))
            ->where('id', '!=',  auth()->id())
            ->having('distance', '<', 0.5)
            ->orderBy('distance', 'asc')
            ->paginate(2);

        return view('home', compact('users'));
    }
}
