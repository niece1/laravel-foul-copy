@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')

<div class="container">
	@if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			@if (Cart::count() > 0)
<h1>{{ Cart::count() }} item(s) in Shopping Cart</h1>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  	@foreach (Cart::content() as $item)
    <tr>
      <th scope="row"><a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ asset('storage/' . $item->model->image) }}" alt="item" width="100" height="100"></a></th>
      <td>{{ $item->model->name }}</td>
      <td>
      	<form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                                 @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form></td>

      <td><form action="{{ route('cart.switchToSaveForLater', $item->rowId) }}" method="POST">
                                @csrf

                                <button type="submit" class="btn btn-warning">Save for Later</button>
                            </form></td>
                            <td><cart-update-component data-id="{{ $item->rowId }}" :old="{{ json_encode($item->qty) }}" ></cart-update-component></td>
      <td>{{ $item->model->price }}</td>
    </tr>
    
    @endforeach
  </tbody>
</table>
<p>Some text</p>
<table class="table table-dark">
  
  <tbody>
  
    <tr>
     
      <td>Shipping is free because we’re awesome like that. Also because that’s additional stuff I don’t feel like figuring out :).</td>
      <td>{{ Cart::subtotal() }}<br>
    <span style="color: red;">Tax 20% </span> {{ Cart::tax() }}</td>
   
      <td>{{ Cart::total() }}</td>
    </tr>
    
 
  </tbody>
</table>

 

<div class="cart-buttons">
                <a href="{{ route('shop') }}" class="btn btn-primary">Continue Shopping</a>
                <a href="{{ route('checkout.index') }}" class="btn btn-primary">Proceed to Checkout</a>
            </div>

            @else

                <h3>No items in the Cart!</h3>
                <div class="spacer"></div>
                <a href="{{ route('shop') }}" class="btn btn-warning">Continue Shopping</a>
                <div class="spacer"></div>

            @endif

</div>
</div>



<div class="container">
	<div class="row">
		<div class="col-md-12">
@if (Cart::instance('saveForLater')->count() > 0)

            <h1>{{ Cart::instance('saveForLater')->count() }} item(s) Saved For Later</h1>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  	@foreach (Cart::instance('saveForLater')->content() as $item)
    <tr>
      <th scope="row"><a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ asset('storage/' . $item->model->image) }}" alt="item" width="100" height="100"></a></th>
      <td>{{ $item->model->name }}</td>
      <td>
      	<form action="{{ route('saveForLater.destroy', $item->rowId) }}" method="POST">
                                 @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form></td>

      <td><form action="{{ route('saveForLater.switchToCart', $item->rowId) }}" method="POST">
                                @csrf

                                <button type="submit" class="btn btn-primary">Move to Cart</button>
                            </form></td>
      <td>{{ $item->model->price }}</td>
    </tr>
    
    @endforeach
  </tbody>
</table>
@else

            <h3>You have no items Saved for Later.</h3>
@endif
</div>
</div>
@endsection

