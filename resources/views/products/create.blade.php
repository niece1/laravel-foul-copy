@extends('layouts.admin')

@section('title', 'Create product')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<h1>Create product</h1>
			
			<form action="{{ action('ProductsController@store') }}" method="post" enctype="multipart/form-data">
				@include('products.form')
				<button type="submit" class="btn btn-dark mt-2">Submit</button>				
			</form>			
		</div>
	</div>
</div>
@endsection