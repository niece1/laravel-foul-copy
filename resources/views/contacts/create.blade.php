@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<h1>Contact us</h1>
			@if(!session()->has('message'))
			<form action="" method="post">

				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" value="{{ old('name') }}" class="form-control">
					<div>{{ $errors->first('name') }}</div>									
				</div>

<div class="form-group">
					<label for="email">Email</label>
					<input type="text" name="email" value="{{ old('email') }}" class="form-control">
					<div>{{ $errors->first('email') }}</div>									
				</div>

				<div class="form-group">
					<label for="message">Message</label>
					<textarea name="message" class="form-control" cols="30" rows="10">{{ old('message') }}</textarea>
					<div>{{ $errors->first('message') }}</div>									
				</div>
				<button type="submit" class="btn btn-primary mt-2">Send</button>
				@csrf
			</form>
			@endif
		</div>
	</div>
</div>
@endsection