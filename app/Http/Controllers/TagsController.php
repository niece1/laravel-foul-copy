<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Article;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
	{
		$tags = Tag::all();

		return view('tags.index', compact('tags'));
	}

	public function create()
	{
		$tags = Tag::all();

		return view('tags.create', compact('tags'));
	}

	public function store()
	{
		$data = request()->validate([
			'title' => 'required|unique:tags,title|min:2'
		]);

		$tag = new Tag();
		$tag->title = request('title');
		$tag->save();

        return back(); // return redirect()->route('task.index');
    }

    public function destroy(Tag $tag)
    {
    	$tag->delete();
    	return redirect('tags');
    }

    public function list($tag)
    {
    	$tags = Tag::find($tag);
    //	$ta = Tag::find($tag)->articles()->get();
    	 
    	return view('tags.list', compact('tags'));
    }
}
