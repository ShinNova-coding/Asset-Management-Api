<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use index;
use Symfony\Contracts\Service\Attribute\Required;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permission=Permission::all();
        $roles=Role::all();
        return view('role.index',compact('permission','roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions=Permission::all();
        return view('role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //data from input
       $request->validate([
        'name'=>'required|unique:roles,name',//role name
        'permissions'=>'required|array'//permissions id array
       ]
       );

       //store in role table
       $role=Role::create([
        'name'=>request('name')      ]
       );

       //adding data in pivot table 
       $role->permission()->attach($request->permissions);
return redirect('/roles')->with('success', 'Role Created Successfully');   
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
    public function edit(Role $role)
    {
        // dd($role->id);
        $permissions=Permission::all();
        return view('role.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {

    //  dd($request->all());
        //get data
         $request->validate([
        'name'=>'required',//role name
        'permissions'=>'required|array'//permissions id array
       ]
       );

       //role table update
        $role->update([
        'name'=>request('name')      ]
       );

       //pivot table update
       $role->permission()->sync($request->permissions);

       return redirect('/roles');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // dd($role->id);
        $role->permission()->detach();
        $role->delete();
        return redirect('/roles');
    }
}
