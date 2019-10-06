@extends('layouts.app')

@section('title', $one->title)

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			
			<div>
				@if($one->image)
				<img src="{{ asset('storage/' . $one->image) }}" alt="photo" class="img-thumbnail">
				@endif
				<h1>{{ $one->title }}</h1>
				<hr>
				<p>{{ $one->content }}</p>
				<small>{{ $one->created_at }}</small>
				<p>In <a href="/categories/{{ $one->category->id }}">{{ $one->category->title }}</a></p>
			</div>
		</div>
	</div>
</div>
@endsection