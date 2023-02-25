<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\Admin\StoreArticleRequest;
use App\Http\Requests\Admin\EditArticleRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')->paginate(20);
        return view('admin.articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('admin.articles.view', compact($article));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(StoreArticleRequest $request)
    {
        $tags = explode(',', $request->tags);

        if($request->has('image'))
        {
            $filename = time() . '.' . $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('uploads/images'), $filename);
        }

        $article = auth()->user()->articles()->create([
            'title' => $request->title,
            'slug' =>Str::slug($request->title),
            'image' => $filename ?? null,
            'article' => $request->article,
            'category_id' => $request->category_id
        ]);

        foreach ($tags as $tagName)
        { 
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        } 

        return redirect()->route('articles.index')->with('success','Article created successfully'); ;
        
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        $tags = $article->tags->implode('name', ', ');

        return view('admin.articles.edit', compact('article', 'categories', 'tags'));
    }
    
    public function update(EditArticleRequest $request, Article $article)
    {
        $tags = explode(',', $request->tags);

        if ($request->has('image')) 
        {
            Storage::delete('public/uploads/' . $article->image);

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('uploads/images'), $filename);
        }

        $article->update([
            'title' => $request->title,
            'image' => $filename ?? $article->image,
            'article' => $request->article,
            'category_id' => $request->category_id
        ]);

        $newTags = [];
        foreach ($tags as $tagName) 
        {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            array_push($newTags, $tag->id);
        }
        $article->tags()->sync($newTags);

        return redirect()->route('articles.index')->with('success','Article updated successfully'); 

    }
    
    public function destroy(Article $article)
    {
        if ($article->image) {
            Storage::delete('public/uploads/' . $article->image);
        }

        $article->tags()->detach();
        $article->delete();
        return redirect()->route('articles.index')->with('success','Article deleted successfully');;   
    }
    
}
