<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        // Category relationship 
        $assets = Asset::with('category')->latest()->get();
        return view('asset.index', compact('assets'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('asset.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_id'        => 'required|string|unique:assets,asset_id',
            'name'            => 'required|string|max:255',
            'serial_number'   => 'required|string|unique:assets,serial_number',
            'purchased_date'  => 'required|date',
            'warranty_expiry' => 'required|date|after_or_equal:purchased_date',
            'category_id'     => 'required|exists:categories,id',
            'status'          => 'required|string',
            'condition'       => 'required|string',
        ]);

        Asset::create([
            'asset_id'        => $request->asset_id,
            'name'            => $request->name,
            'serial_number'   => $request->serial_number,
            'purchased_date'  => $request->purchased_date,
            'warranty_expiry' => $request->warranty_expiry,
            'category_id'     => $request->category_id,
            'status'          => $request->status,
            'condition'       => $request->condition,
        ]);

        return redirect('/assets')->with('success', 'Asset Created Successfully');
    }

    public function edit(Asset $asset)
    {
        $categories = Category::all();
        return view('asset.edit', compact('asset', 'categories'));
    }

    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'serial_number'   => "required|string|unique:assets,serial_number,{$asset->asset_id},asset_id",
            'purchased_date'  => 'required|date',
            'warranty_expiry' => 'required|date|after_or_equal:purchased_date',
            'category_id'     => 'required|exists:categories,id',
            'status'          => 'required|string',
            'condition'       => 'required|string',
        ]);

        $asset->update($request->all());

        return redirect('/assets')->with('success', 'Asset Updated Successfully');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();
        return redirect('/assets')->with('success', 'Asset Deleted Successfully');
    }
}