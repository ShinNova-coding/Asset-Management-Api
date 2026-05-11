<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('assets')->latest()->get();
        return response()->json(['status' => 'success', 'data' => $categories], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $category = Category::create($request->only('name'));
        return response()->json(['status' => 'success', 'data' => $category], 201);
    }

    public function show(Category $category)
    {
        return response()->json(['status' => 'success', 'data' => $category->load('assets')], 200);
    }

    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $category->update($request->only('name'));
        return response()->json(['status' => 'success', 'message' => 'Category updated successfully'], 200);
    }

    public function destroy(int $id)
    {
        $deleted = Category::destroy($id);

        if (!$deleted) {
            return response()->json(['status' => 'error', 'message' => 'Category not found'], 404);
        }

        return response()->json(['status' => 'success', 'message' => 'Category deleted successfully'], 200);
    }

}
