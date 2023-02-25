<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(8);


        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->all());
        return redirect()->route('categories.index')->with('success','Category created successfully');    
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));;
    }

    public function update(StoreCategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return redirect()->route('categories.index')->with('success','Category updated successfully'); 
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success','Category deleted successfully');   
    }
}
