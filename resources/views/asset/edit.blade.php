@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 p-8 bg-white rounded-3xl shadow-lg">
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Edit Asset: {{ $asset->name }}</h2>
        <p class="text-gray-500 text-sm">Update technical specifications and current status of the asset.</p>
    </div>

    <form action="/assets/{{ $asset->asset_id }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Asset ID</label>
                <input type="text" name="asset_id" value="{{ $asset->asset_id }}" readonly
                    class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg text-gray-500 cursor-not-allowed outline-none">
                <p class="text-xs text-gray-400 mt-1">Asset ID is unique and cannot be changed.</p>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Asset Name</label>
                <input type="text" name="name" value="{{ $asset->name }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Serial Number</label>
                <input type="text" name="serial_number" value="{{ $asset->serial_number }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Category</label>
                <select name="category_id" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $asset->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Purchased Date</label>
                <input type="date" name="purchased_date" value="{{ $asset->purchased_date }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Warranty Expiry</label>
                <input type="date" name="warranty_expiry" value="{{ $asset->warranty_expiry }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Current Status</label>
                <select name="status" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                    <option value="available" {{ $asset->status == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="assigned" {{ $asset->status == 'assigned' ? 'selected' : '' }}>Assigned</option>
                    <option value="maintenance" {{ $asset->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="retired" {{ $asset->status == 'retired' ? 'selected' : '' }}>Retired</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Condition</label>
                <select name="condition" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                    <option value="new" {{ $asset->condition == 'new' ? 'selected' : '' }}>New</option>
                    <option value="good" {{ $asset->condition == 'good' ? 'selected' : '' }}>Good</option>
                    <option value="fair" {{ $asset->condition == 'fair' ? 'selected' : '' }}>Fair</option>
                    <option value="poor" {{ $asset->condition == 'poor' ? 'selected' : '' }}>Poor</option>
                    <option value="damaged" {{ $asset->condition == 'damaged' ? 'selected' : '' }}>Damaged</option>
                </select>
            </div>
        </div>

        <div class="flex items-center justify-end space-x-4 border-t pt-6">
            <a href="/assets" class="text-gray-500 hover:text-gray-700 font-medium transition">Cancel</a>
            <button type="submit" 
                class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg transition transform active:scale-95">
                Update Asset Info
            </button>
        </div>
    </form>
</div>
@endsection