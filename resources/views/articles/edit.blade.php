@extends('layouts.admin')

@section('title', 'Edit' . $article->name)

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<h1>Edit article</h1>
			
			<form action="/articles/{{ $article->id }}" method="post" enctype="multipart/form-data">
				@method('PATCH')
				@include('articles.form')
				<button type="submit" class="btn btn-dark mt-2">Save</button>				
			</form>			
		</div>
	</div>
</div>
@endsection