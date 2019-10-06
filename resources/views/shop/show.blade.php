@extends('layouts.app')

 @section('title', $product->name)

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			
			<div>
				@if($product->image)
				<img src="{{ asset('storage/' . $product->image) }}" alt="photo" class="img-thumbnail">
				@endif
				<h1>{{ $product->name }}</h1>
				<hr>
				<p>{{ $product->details }}</p>
				<p>{{ $product->description }}</p>
				<p>{{ $product->presentPrice() }}</p>
				<small>{{ $product->created_at }}</small>
				<form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <button type="submit" class="btn btn-success">Add to Cart</button>
                </form>
			</div>
		</div>
	</div>
	@include('looks-like')
</div>
@endsection

