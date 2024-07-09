<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAvatarController extends Controller
{
    public function update(Request $request):string{
        $path=$request->file('regphoto').storeAs(
             'avatars/'.$request->user()->id, 's3');
        return $path;
    }
}
