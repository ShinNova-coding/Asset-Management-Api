<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request->all();
    $credential=request()->validate([
    'email'=>'required|email',
    'password'=>'required']
    );

    if(Auth::attempt($credential)){

    $request->session()->regenerate();

    $user=Auth::user();

    // User ရဲ့ role ထဲမှာ 'view-dashboard' ဆိုတဲ့ permission ပါလား စစ်မယ်
    if ($user->role && $user->role->permissions->contains('name', 'view-dashboard')) {
        return redirect('/dashboard');
    }
    elseif($user->role && $user->role->permissions->contains('name', 'view-my-assets')) {
        return redirect('/asset');
    }
   
    else{
        return redirect('/login')->with('error','Invalid role');
    }
    }
    // // $url=match($user->role->name){
    // //     'Admin'=>'/dashboard',
    // //     'Employee'=>'/asset',
    // //     'HR'=>'/dashboard',
    // //     default=>'/login'
    // // };

    // return redirect('/dashboard');

    // // if($user->role->name=='Admin'){
    // //     return redirect('/dashboard');
    // // }
    // // elseif($user->role->name=='Employee'){
    // //     return redirect('/asset');
    // // }
    // // elseif($user->role->name=='HR'){
    // //     return redirect('/dashboard');
    // // }
    // // else{
    // //     return redirect('/login')->with('error','Invalid role');
    // // }
    // }

    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/login');
    }
}
