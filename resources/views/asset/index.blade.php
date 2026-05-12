@extends('layouts.app')
@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Asset Management</h1>
            <p class="text-gray-500 mt-1">Manage and track company assets.</p>
        </div>
        <a href="/assets/create" class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl shadow-sm transition font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add New Asset
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden p-6">
        <table id="assetTable" class="display stripe hover" style="width:100%">
            <thead>
                <tr>
                    <th>Asset ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Condition</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assets as $asset)
                <tr>
                    <td class="font-bold text-blue-600">{{ $asset->asset_id }}</td>
                    <td>{{ $asset->name }}</td>
                    <td>{{ $asset->category->name }}</td>
                    <td><span class="px-2 py-1 rounded-lg text-xs {{ $asset->status == 'available' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">{{ strtoupper($asset->status) }}</span></td>
                    <td>{{ ucfirst($asset->condition) }}</td>
                    <td>
                        <div class="flex items-center gap-2">
                            <a href="/assets/{{ $asset->asset_id }}/edit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl text-sm transition">Edit</a>
                            <form action="/assets/{{ $asset->asset_id }}" method="POST" onsubmit="return confirm('Delete this asset?')">
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
    $(document).ready(function() { $('#assetTable').DataTable(); });
</script>
@endsection