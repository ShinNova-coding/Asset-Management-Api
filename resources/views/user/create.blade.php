@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto mt-10 p-8 bg-white rounded-3xl shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Create New User</h2>
    <form action="/users" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Employee ID</label>
                <input type="text" name="employee_id" required class="w-full px-4 py-3 border rounded-lg" placeholder="EMP-001">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Full Name</label>
                <input type="text" name="name" required class="w-full px-4 py-3 border rounded-lg">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Email Address</label>
                <input type="email" name="email" required class="w-full px-4 py-3 border rounded-lg">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">System Role</label>
                <select name="role_id" class="w-full px-4 py-3 border rounded-lg">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Joined Date</label>
                <input type="date" name="joined_date" required class="w-full px-4 py-3 border rounded-lg">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 border rounded-lg">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Confirm Password</label>
                <input type="password" name="password_confirmation" required class="w-full px-4 py-3 border rounded-lg">
            </div>
        </div>
        <div class="flex justify-end space-x-4 border-t pt-6">
            <a href="/users" class="text-gray-500 py-2.5">Cancel</a>
            <button type="submit" class="px-8 py-2.5 bg-blue-600 text-white font-bold rounded-lg shadow-md hover:bg-blue-700">Save User</button>
        </div>
    </form>
</div>
@endsection