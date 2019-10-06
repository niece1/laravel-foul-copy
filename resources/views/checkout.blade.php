@extends('layouts.app')

@section('title', 'Checkout')
<script src="https://js.stripe.com/v3/"></script>
@section('extra-css')
<style>
	.mt-32 {
		margin-top: 32px;
	}
</style>



@endsection

@section('content')
<div class="container">
	@if (session()->has('success_message'))
            <div class="spacer"></div>
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="spacer"></div>
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif

	<h1>Checkout</h1>
	<div class="row justify-content-center">
		
		<div class="col-md-4">
			<form action="{{ route('checkout.store') }}" id="payment-form" method="post" enctype="multipart/form-data">

				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" value="" class="form-control">
					<div>{{ $errors->first('title') }}</div>
				</div>

				<div class="form-group">
					<label for="email">Email</label>
					@if (auth()->user())
					<input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control" readonly>
					@else
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        @endif
					<div>{{ $errors->first('email') }}</div>
				</div>

				<div class="form-group">
					<label for="address">Address</label>
					<input type="text" name="address" value="" class="form-control">
					<div>{{ $errors->first('address') }}</div>
				</div>

				<div class="form-group">
					<label for="city">City</label>
					<input type="text" name="city" value="" class="form-control">
					<div>{{ $errors->first('city') }}</div>
				</div>

				<div class="form-group">
					<label for="state">State</label>
					<input type="text" name="state" value="" class="form-control">
					<div>{{ $errors->first('state') }}</div>
				</div>

				<div class="form-group">
					<label for="postal-code">Postal Code</label>
					<input type="number" name="postal-code" value="" class="form-control">
					<div>{{ $errors->first('postal-code') }}</div>
				</div>

				<div class="form-group">
					<label for="phone">Phone</label>
					<input type="text" name="phone" value="" class="form-control">
					<div>{{ $errors->first('phone') }}</div>
				</div>



				<h2>Payment details</h2>

				<div class="stripe">

					<div class="form-group">
						<label for="card-element">
							Credit or debit card
						</label>
						<div id="card-element">
							<!-- A Stripe Element will be inserted here. -->
						</div>
					</div>
				</div>
				<button type="submit" id="completed-order" class="btn btn-dark mt-2">Complete order</button>	
				@csrf

			</form>
		</div>

		

		<div class="col-md-6">
			
			<table class="table">
				<thead>
					<tr>
						<th scope="col"></th>
						<th scope="col"></th>
						<th scope="col"></th>

					</tr>
				</thead>
				<tbody>
					@foreach (Cart::content() as $item)
					<tr>
						<td scope="row">
							<a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ asset('storage/' . $item->model->image) }}" alt="item" width="100" height="100"></a>
						</td>
						<td>{{ $item->model->name }}<br>{{ $item->model->details }}<br>{{ $item->model->price }}</td>
						<td></td>

					</tr>

					@endforeach
				</tbody>
			</table>
			<p>Some text</p>

			@if (! session()->has('coupon'))



                <a href="#" class="have-code">Have a Coupon?</a>

                <div class="have-code-container">
                    <form action="{{ route('coupon.store') }}" method="POST">
                        @csrf
                        <input type="text" name="coupon_code" id="coupon_code">
                        <button type="submit" class="btn btn-primary">Apply</button>
                    </form>
                </div> <!-- end have-code-container -->
            
           
            @endif

			<table class="table table-dark">

				<tbody>

					<tr>     
						<td>Subtotal</td>
						<td>{{ Cart::subtotal() }}</td>     
					</tr>

                    @if (session()->has('coupon'))   

					<tr>     
						<td>Discount: ({{ session()->get('coupon')['name'] }}) <form action="{{ route('coupon.destroy') }}" method="POST">
                                @csrf
                                {{ method_field('delete') }}
                                <button type="submit" style="border:none; background: transparent; color: red;">Remove</button>
                            </form></td>
						<td>-{{ session()->get('coupon')['discount'] }}</td>     
					</tr>

					<tr>
						<td>New Subtotal</td>
						<td>{{ $newSubtotal }}</td>
					</tr>

					<tr>     
						<td>Tax</td>
						<td>{{ $newTax }}</td>     
					</tr>

					<tr>
						<td>Total</td>
						<td>{{ $newTotal }}</td>
					</tr>

					@endif

                    @if (! session()->has('coupon'))
					<tr>     
						<td>Tax</td>
						<td>{{ Cart::tax() }}</td>     
					</tr>

					<tr>    
						<td>Total</td>     
						<td>{{ Cart::total() }}</td>
					</tr>
                     @endif

				</tbody>
			</table>
		</div>

	</div>
	
</div>
@endsection

@section('extra-js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
	// Create a Stripe client.
var stripe = Stripe('{{ config('services.stripe.key') }}');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style, hidePostalCode: true});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

                // Disable the submit button to prevent repeated clicks. This is not from Stripe docs
              document.getElementById('completed-order').disabled = true;

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;

      // Enable the submit button. This is not from Stripe docs
                  document.getElementById('completed-order').disabled = false;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
});
</script>

@endsection