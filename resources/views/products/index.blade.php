@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">name</th>
            <th scope="col">slug</th>
            <th scope="col">image</th>
            <th scope="col">details</th>
            <th scope="col">price</th>
            <th scope="col">description</th>         
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
          <tr>           
            <th scope="row">{{ $product->id }}</th>
            <td><a href="/products/{{ $product->id }}">{{ $product->name }}</a></td>
          
            <td>{{ $product->slug }}</td>
            <td>
              @if($product->image)
              <img src="{{ asset('storage/' . $product->image) }}" alt="photo" class="img-thumbnail">
            @endif
          </td>
              <td>{{ $product->details }}</td> 
              <td>{{ $product->price }}</td>
              <td>{{ $product->description }}</td>          
            <td><a href="/products/{{ $product->id }}/edit" class="btn btn-info">Edit</a></td>
            <td>
              <form action="/products/{{ $product->id }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>             
          </tr>
          @endforeach
        </tbody>
      </table>
      <a href="/products/create" class="btn btn-success">Create</a>
    </div>
  </div>

  <div class="row">
    <div class="col-12 d-flex justify-content-center pt-3">
      {{ $products->links() }}
    </div>
  </div>

</div>
@endsection