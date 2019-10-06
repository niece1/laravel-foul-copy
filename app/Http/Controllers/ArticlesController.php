<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ArticlesController extends Controller
{
    public function index()
    {
    	$articles = Article::paginate(15);
    	
    	return view('articles.index', compact('articles'));
    }

    public function create()
    {
    	$categories = Category::all();
        $tags = Tag::all();
    	$article = new Article(); // this query need only to avoid mistake in articles/create because of old values from edit

    	return view('articles.create', compact('categories', 'tags', 'article'));
    }

    public function store()
    {
    	$article = Article::create($this->validateRequest());

        $this->storeImage($article);
     //   $tags = request('tag_id');
        $this->syncTags($article);
      $this->getUser($article);

        return redirect('articles');//return back();
    }

    private function validateRequest()
    {
    	return request()->validate([
          'title' => 'required|min:3',
          'content' => 'required',
          'status' => 'required',
          'category_id' => 'required',
          'image' => 'sometimes|file|image|max:5000',
      ]); 
    }    

    public function show($article)
    {
    	// $article = Article::find($id);
    	$article = Article::where('id', $article)->firstOrFail();
     //   dd($article);
    	return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
      $categories = Category::all();
      $tags = Tag::all();

      return view('articles.edit', compact('article', 'categories', 'tags'));
    }

  public function update(Article $article)
  {
     $article->update($this->validateRequest());
     $this->storeImage($article);
     $this->syncTags($article);
     $this->getUser($article);
     return redirect('articles/' . $article->id);
 }

 public function destroy(Article $article)
 {
     $article->delete();
     return redirect('articles');
 }

 public function list()
 {
     $news = Article::where('status', 0)->get();
     $categories = Category::all();
     $tags = Tag::all();

     return view('blog.index', compact('news', 'categories', 'tags'));
 }

 public function listshow(Article $one)
 {
    $one->viewedCounter();

     return view('blog.show', compact('one'));
 }

 private function storeImage($article)
 {
    if(request()->has('image')) {
        $article->update([
            'image' => request()->image->store('uploads', 'public'),
        ]);
        $image = Image::make(public_path('storage/' . $article->image))->fit(300, 300);
        $image->save();
    }
}
    private function syncTags($article)
 {
     $article->tags()->sync(request('tag_id'));
 }

 private function getUser($article)
 {

    Auth::user() ? Auth::user()->articles()->save($article) : '';
 }

 


}
