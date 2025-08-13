<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //
    public function followOrUnfollow(User $user) {
        //auth()->user()->following()->toggle($user);
        $user->followers()->toggle(auth()->user());
        return response()->json([
            'followersCount' => $user->followers()->count(),
        ]);
    }
}
