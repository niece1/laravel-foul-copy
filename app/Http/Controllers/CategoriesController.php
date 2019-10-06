<?php

namespace App\Http\Controllers;

use App\Category;
use App\Article;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
	public function index()
	{
		$categories = Category::all();

		return view('categories.index', compact('categories'));
	}

	public function create()
	{
		$categories = Category::all();

		return view('categories.create', compact('categories'));
	}

	public function store()
	{
		$data = request()->validate([
			'title' => 'required|unique:categories,title|min:2'
		]);

		$category = new Category();
		$category->title = request('title');
		$category->save();

        return back(); // return redirect()->route('task.index');
    }

    public function destroy(Category $category)
    {
    	$category->delete();
    	return redirect('categories');
    }

    public function list($category)
    {
     // $articles_by_category = Category::where('id', $category)->firstOrFail();

    	$articles_by_category = Article::where(['category_id'=> $category, 'status' => '0'])->get();
    	return view('categories.list', compact('articles_by_category'));
    }


}
