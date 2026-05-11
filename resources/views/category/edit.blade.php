@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto mt-10 p-8 bg-white rounded-3xl shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Category: {{ $category->name }}</h2>
    <form action="/categories/{{ $category->id }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-8">
            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Category Name</label>
            <input type="text" name="name" value="{{ $category->name }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
        </div>
        <div class="flex items-center justify-end space-x-4 border-t pt-6">
            <a href="/categories" class="text-gray-500 hover:text-gray-700 font-medium">Cancel</a>
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md transition transform active:scale-95">Update Category</button>
        </div>
    </form>
</div>
@endsection