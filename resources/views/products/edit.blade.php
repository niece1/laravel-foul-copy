@extends('layouts.admin')


@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<h1>Edit product</h1>
			
			<form action="/products/{{ $product->id }}" method="post" enctype="multipart/form-data">
				@method('PATCH')
				@include('products.form')
				<button type="submit" class="btn btn-dark mt-2">Save</button>				
			</form>			
		</div>
	</div>
</div>
@endsection