<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Http\Requests\Admin\StoreTagRequest;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate(10);
        return view('admin.tags.index', compact('tags'));
    }
    
    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(StoreTagRequest $request)
    {
        $tag = Tag::create($request->all());
        return redirect()->route('tags.index')->with('success','Tag created successfully'); 
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(StoreTagRequest $request, Tag $tag)
    {
        $tag->update($request->all());

        return redirect()->route('tags.index')->with('success','Tag updated successfully'); 
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('success','Tag deleted successfully');;   
    }
}
