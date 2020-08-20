<?php

namespace App\Http\Controllers;

use App\Likes;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {

    }

    public function setLike($id) {

        $reacted_me = Likes::where('target_user', auth()->user()->id)
                            ->where('base_user', $id)->first();

        if ($reacted_me) {
            $update = Likes::where('target_user', auth()->user()->id)
                            ->where('base_user', $id)
                            ->update(['target_user_like' => "yes"]);
            if($reacted_me->base_user_like === "yes") {
                return redirect()->back()->with('status', 'Congratulation it is a match');
            }
        }
        else {
            $reacted_by_me = Likes::where('target_user', $id)
                                ->where('base_user', auth()->user()->id)->first();

            if (!$reacted_by_me) {
                Likes::create([
                    'base_user'     => auth()->user()->id,
                    'target_user'   => $id,
                    'base_user_like'=> "yes",
                ]);
            }

        }

        return redirect()->back();


    }

    public function setDislike($id) {

        $reacted_me = Likes::where('target_user', auth()->user()->id)
            ->where('base_user', $id)->first();

        if ($reacted_me) {
            $update = Likes::where('target_user', auth()->user()->id)
                ->where('base_user', $id)
                ->update(['target_user_like' => "no"]);

        }
        else {
            $reacted_by_me = Likes::where('target_user', $id)
                ->where('base_user', auth()->user()->id)->first();

            if (!$reacted_by_me) {
                Likes::create([
                    'base_user'     => auth()->user()->id,
                    'target_user'   => $id,
                    'base_user_like'=> "no",
                ]);
            }
        }

        return redirect()->back();

    }
}
