<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Restaurant\User;
//use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiUserController extends Controller
{

    public function index()
    {
        if(Auth::user()->can('read-users')) {
            $request = request();

            // handle sort option
            if (request()->has('sort')) {
                list($sortCol, $sortDir) = explode('|', request()->sort);
                $query = User::orderBy($sortCol, $sortDir);
            } else {
                $query = User::orderBy('id', 'asc');
            }

            if ($request->exists('filter')) {
                $query->where(function($q) use($request) {
                    $value = "%{$request->filter}%";
                    $q->where('name', 'like', $value)
                        ->orWhere('nickname', 'like', $value)
                        ->orWhere('email', 'like', $value);
                });
            }

            $perPage = request()->has('per_page') ? (int) request()->per_page : null;

            // The headers 'Access-Control-Allow-Origin' and 'Access-Control-Allow-Methods'
            // are to allow you to call this from any domain (see CORS for more info).
            // This is for local testing only. You should not do this in production server,
            // unless you know what it means.
            return response()->json(
                $query->paginate($perPage)
            )
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET');
        }
        return redirect('/logout');
    }
    public function create() {
        if(Auth::user()->can('create-users')) {
            return Role::orderBy('display_name', 'asc')->lists('display_name', 'id');
            //return view('auth::user.create', compact('roles'));
        }
        return redirect('/logout');
    }
    public function store(Request $request)
    {
        
        /*
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
                        */
        if(Auth::user()->can('create-users')) {
            return User::create($request->all());
        }
        return redirect('/logout');
    }
    /**
     * muestra datos del recurso y combos asociados para editar
     */
    public function edit($id) {
        if(Auth::user()->can('update-users')) {
            $user = User::findOrFail($id);
            $roles_user = User::find($id)->roles()->lists('role_id')->toArray();
            $roles = Role::orderBy('display_name', 'asc')->lists('display_name', 'id');
            return view('auth::user.edit', compact('user', 'roles', 'roles_user'));
        }
        return redirect('/logout');
    }

    /*public function show() {
        return view('auth::user.form_change_password');
    }*/
    /**
     * solo muestra datos del recurso
     */
    public function show($id)
    {
        /*
        $user = User::find($id);
        $roles = Role::lists('display_name','id');
        $userRole = $user->roles->lists('id','id')->toArray();

        return view('users.edit',compact('user','roles','userRole'));*/
        if(Auth::user()->can('read-users')) {
            return User::findOrFail($id);
        }
        return redirect('/logout');
    }

    public function update(Request $request, $id)
    {
        /*
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('role_user')->where('user_id',$id)->delete();

        
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
                        */
        if(Auth::user()->can('update-users')) {

            User::findOrFail($id)->update($request->all());
            return response()->json($request->all()); //response()->json()
        }
        return redirect('/logout');
    }

    public function destroy($id)
    {
        if($this->user->can('delete-users')) {
            return User::destroy($id);
        }
        return redirect('/logout');
    }
}
