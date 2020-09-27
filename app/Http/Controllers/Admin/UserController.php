<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! request()->get('find')) {
            $user = User::orderBy('name', 'asc');
        }
        else {
            $user = User::where('name', 'like', '%' . request()->get('find') . '%');
        }

        if (request()->get('role') && request()->get('role') != 'All') {
            $user = $user->where('role_id', request()->get('role'));
        }

        if (request()->get('sort')) {
            $user = $user->orderBy(request()->get('sort'), 'asc')->paginate(25);
        }
        else {
            $user = $user->orderBy('name', 'asc')->paginate(25);
        }






        if(Auth::user()->role_id != 3) {
            abort(404);
        }
        return view('admin.users.index', [
            'users' => $user,
            'roles' => Role::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit')->
        with('roles', \App\Role::all() ) ->
        with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'max:20',
        ]);

        $user->name = $request->input('name');
        $user->comments_access = (isset($request->comments_access)) ? 1 : 0;
        $user->ufr_files_access = (isset($request->ufr_files_access)) ? 1 : 0;
        $user->role_id = $request->input('role');
        $user->save();

        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return  redirect()->route('admin.user.index');
    }
}
