<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Http\Requests\StoreArticleRequest;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')->paginate(20);
        return view('admin.articles.index', compact($articles));
    }

    public function show(Article $article)
    {
        return view('admin.articles.view', compact($article));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create');
    }

    public function store(StoreArticleRequest $request)
    {
        $tags = explode(',', $request->tags);

        if($request->has('image'))
        {
            $filename = time() . '.' . $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('uploads/images'), $imageName);
        }

        $article = auth()->user()->articles()->create([
            'title' => $request->title,
            'slug' =>Str::slug($request->title),
            'image' => $filename ?? null,
            'article' => $request->article,
            'category_id' => $request->category
        ]);

        foreach ($tags as $tagName)
        { 
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        } 

        return redirect()->route('admin.articles.index');
        
    }

    public function edit(Article $article)
    {
        $categories = Category::all();

        return view('admin.articles.edit', compact($article, $categories));;
    }
    
    public function update()
    {

    }
    
    public function destroy(Article $article)
    {

        return view('admin.articles.index');
    }
    
}
