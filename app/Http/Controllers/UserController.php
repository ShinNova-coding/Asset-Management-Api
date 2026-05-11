<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{


   

    public function index(Request $request)
    {
        $users = User::with('role')->latest()->get();

        // အကယ်၍ Axios (AJAX) ကနေ လာတာဆိုရင် JSON Data ပြန်ပေးမယ်
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['status' => 'success', 'data' => $users], 200);
        }

        // Browser ကနေ တိုက်ရိုက်ခေါ်တာဆိုရင် Blade UI ကို ပြန်ပေးမယ်
        return view('manageuser', compact('users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id'  => 'required|string|unique:users,employee_id',
            'name'         => 'required|string|max:255',
            'role_id'      => 'required|exists:roles,id',
            'email'        => 'required|email|unique:users,email',
            'joined_date'  => 'required|date',
            'password'     => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['status'] = $request->status ?? 'active';
        
        $user = User::create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'User created successfully',
            'data'    => $user->load('role')
        ], 201);
    }

    // Route Model Binding: (User $user) လို့ ရေးရုံနဲ့ ID နဲ့ ရှာပြီးသား ဖြစ်သွားပါပြီ
    public function show(User $user)
    {
        return response()->json(['status' => 'success', 'data' => $user->load(['role', 'assets'])], 200);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'sometimes|string|max:255',
            'role_id'   => 'sometimes|exists:roles,id',
            'email'     => 'sometimes|email|unique:users,email,' . $user->id,
            'left_date' => 'nullable|date|after_or_equal:joined_date',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'User updated successfully',
            'data'    => $user->load('role')
        ], 200);
    }

    /**
     *  direct delete with ID, deleted row qty store in $deleted 
     */
    public function destroy(int $id)
    {      
        $deleted = User::destroy($id);

        if (!$deleted) {
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }

        return response()->json(['status' => 'success', 'message' => 'User deleted successfully'], 200);
    }

}
