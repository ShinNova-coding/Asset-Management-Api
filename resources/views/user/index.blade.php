@extends('layouts.app')
@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">User Management</h1>
            <p class="text-gray-500 mt-1">Manage system users and their roles.</p>
        </div>
        <a href="/users/create" class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl shadow-sm transition font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Create User
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-2xl">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden p-6">
        <table id="userTable" class="display stripe hover" style="width:100%">
            <thead>
                <tr>
                    <th>Emp ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="font-bold">{{ $user->employee_id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs">{{ $user->role->name }}</span></td>
                    <td>{{ $user->joined_date }}</td>
                    <td>
                        <div class="flex items-center gap-3">
                            <a href="/users/{{ $user->id }}/edit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-xl text-sm">Edit</a>
                            <form action="/users/{{ $user->id }}" method="POST" onsubmit="return confirm('Delete this user?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-xl text-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () { $('#userTable').DataTable({ responsive: true }); });
</script>
@endsection