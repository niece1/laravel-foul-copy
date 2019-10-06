@extends('layouts.admin')

@section('title', 'Create article')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<h1>Create article</h1>
			
			<form action="{{ route('articles.store') }}" method="post" enctype="multipart/form-data">
				@include('articles.form')
				<button type="submit" class="btn btn-dark mt-2">Submit</button>				
			</form>			
		</div>
	</div>
</div>
@endsection