<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    
    public function index()
    {
        return view('users.fetchUser');
    }
    public function changePassword(Request $request) {
        $this->validate($request, [
            'password' => 'required|confirmed|min:5',
            'password_confirmation' => 'required|min:5',
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $data = array(
            'password' => \Hash::make($request->input('password'))
        );
        $user->update($data);
        Session::flash('message', trans('auth::ui.user.message_change_password'));
        return redirect('auth/user/change-password');
    }
}
