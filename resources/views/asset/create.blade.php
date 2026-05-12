@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto mt-10 p-8 bg-white rounded-3xl shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Create New Asset</h2>
    <form action="/assets" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Asset ID</label>
                <input type="text" name="asset_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg outline-none focus:ring-2 focus:ring-blue-500" placeholder="AST-0001">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Asset Name</label>
                <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Serial Number</label>
                <input type="text" name="serial_number" required class="w-full px-4 py-3 border border-gray-300 rounded-lg outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Category</label>
                <select name="category_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Purchased Date</label>
                <input type="date" name="purchased_date" required class="w-full px-4 py-3 border border-gray-300 rounded-lg outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Warranty Expiry</label>
                <input type="date" name="warranty_expiry" required class="w-full px-4 py-3 border border-gray-300 rounded-lg outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-lg outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="available">Available</option>
                    <option value="assigned">Assigned</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Condition</label>
                <select name="condition" class="w-full px-4 py-3 border border-gray-300 rounded-lg outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="new">New</option>
                    <option value="fair">Fair</option>
                    <option value="damaged">Damaged</option>
                </select>
            </div>
        </div>
        <div class="flex items-center justify-end space-x-4 border-t pt-6">
            <a href="/assets" class="text-gray-500 hover:text-gray-700 font-medium">Cancel</a>
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md transition transform active:scale-95">Save Asset</button>
        </div>
    </form>
</div>
@endsection