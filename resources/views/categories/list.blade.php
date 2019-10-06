@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @foreach ($articles_by_category as $one)
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
    
</div>
</div>
@endsection