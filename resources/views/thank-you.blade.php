@extends('layouts.app')

@section('title', 'Thank you')

@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
<h1>Thank you for your order!</h1>
<p>Confirmation email sent.</p>
<a href="{{ route('home') }}" class="btn btn-primary">Back to home</a>
		</div>
	</div>
</div>

@endsection