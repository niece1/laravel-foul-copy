@extends('layouts.app')

@section('content')

    <div class="shop">
      <div class="shop-wrapper">
      @foreach ($products as $one)
      <div class="shop-item">
        @if($one->image) 
        <a href="/shop/{{ $one->slug }}"><img src="{{ asset('storage/' . $one->image) }}" alt="photo" class="img-thumbnail"></a>
        @endif
        <h4>{{ $one->name }}</h4>
        <p>{{ $one->details }}</p>
        <small>{{ $one->updated_at }}</small>
        <p>{{ $one->presentPrice() }}</p>
        <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $one->id }}">
                    <input type="hidden" name="name" value="{{ $one->name }}">
                    <input type="hidden" name="price" value="{{ $one->price }}">
                    <button type="submit" class="btn btn-success">Add to Cart</button>
                </form>
      </div>
      @endforeach
    </div>
    </div>

@endsection