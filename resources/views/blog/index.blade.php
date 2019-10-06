@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @foreach ($news as $one)
      <div class="mb-3">
        @if($one->image) 
        <img src="{{ asset('storage/' . $one->image) }}" alt="photo" class="img-thumbnail">
        @endif
        <h4>{{ $one->title }}</h4>
        <p>{{ $one->content }}</p>
        <small>{{ $one->updated_at }}</small>
        
        <p>in <a href="/categories/{{ $one->category->id }}">{{ $one->category->title }}</a></p>
        <a href="/blog/{{ $one->id }}" class="btn btn-danger">Read more</a>
      </div>
      @endforeach
    </div>
    <ul>
      <h3>Choose category</h3>
     @foreach ($categories as $category)
     <li>
      <a href="/categories/{{ $category->id }}">{{ $category->title }}</a>
    </li>
    @endforeach
  </ul>

  <ul>
      <h3>Choose tags</h3>
     @foreach ($tags as $tag)
     <li>
      <a href="/tags/{{ $tag->id }}">{{ $tag->title }}</a>
    </li>
    @endforeach
  </ul>
</div>
</div>
@endsection