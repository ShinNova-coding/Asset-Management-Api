@extends('layouts.app')
@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Category Management</h1>
            <p class="text-gray-500 mt-1">Organize your assets by categories.</p>
        </div>
        <a href="/categories/create" class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl shadow-sm transition font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Create Category
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-2xl">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden p-6">
        <table id="categoryTable" class="display stripe hover" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $key => $category)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td class="font-semibold text-gray-800">{{ $category->name }}</td>
                    <td>
                        <div class="flex items-center gap-3">
                            <a href="/categories/{{ $category->id }}/edit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl text-sm transition">Edit</a>
                            <form action="/categories/{{ $category->id }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm transition">Delete</button>
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
    $(document).ready(function () { $('#categoryTable').DataTable({ responsive: true }); });
</script>
@endsection