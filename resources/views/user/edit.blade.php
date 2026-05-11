@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 p-8 bg-white rounded-3xl shadow-lg">
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Edit User: {{ $user->name }}</h2>
        <p class="text-gray-500 text-sm">Update user information and system access levels.</p>
    </div>

    <form action="/users/{{ $user->id }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Employee ID</label>
                <input type="text" name="employee_id" value="{{ $user->employee_id }}" readonly
                    class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg text-gray-500 cursor-not-allowed outline-none">
                <p class="text-xs text-gray-400 mt-1">Employee ID cannot be changed.</p>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Full Name</label>
                <input type="text" name="name" value="{{ $user->name }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Email Address</label>
                <input type="email" name="email" value="{{ $user->email }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">System Role</label>
                <select name="role_id" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Joined Date</label>
                <input type="date" name="joined_date" value="{{ $user->joined_date }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

             <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Left Date (Optional)</label>
                <input type="date" name="left_date" value="{{ $user->left_date }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div class="md:col-span-2 p-4 bg-blue-50 border border-blue-100 rounded-xl">
                <label class="block text-sm font-bold text-blue-800 mb-2 uppercase tracking-wide">Update Password</label>
                <input type="password" name="password" 
                    class="w-full px-4 py-3 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition"
                    placeholder="Leave blank to keep current password">
                <p class="text-xs text-blue-500 mt-2 italic">Note: Only fill this if you want to change the user's password.</p>
            </div>
        </div>

        <div class="flex items-center justify-end space-x-4 border-t pt-6">
            <a href="/users" class="text-gray-500 hover:text-gray-700 font-medium transition">Cancel</a>
            <button type="submit" 
                class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg transition transform active:scale-95">
                Update User Profile
            </button>
        </div>
    </form>
</div>
@endsection