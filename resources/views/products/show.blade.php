@extends('layouts.admin')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table table-bordered table-dark">
              <thead>
                <tr>
                  <th scope="col">id</th>
                  <th scope="col">{{ $product->id }}</th>
                 
              </tr>
          </thead>
          <tbody>
          
            <tr>           
              <td scope="row">name</th>
              <td>{{ $product->name }}</td>          
          </tr>

          <tr>           
              <td scope="row">slug</th>
              <td>{{ $product->slug }}</td>          
          </tr>

          <tr>           
              <td scope="row">image</th>
              <td>@if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="photo" class="img-thumbnail"></td>
                @endif       
          </tr>

          <tr>           
              <td scope="row">details</th>
              <td>{{ $product->details }}</td>          
          </tr>

          <tr>           
              <td scope="row">price</th>
              <td>{{ $product->price }}</td>          
          </tr>

          <tr>           
              <td scope="row">Description</th>              
              <td>{{ $product->description }}</td>     
          </tr>
          
          <tr>           
              <td scope="row">created_at</th>
              <td>{{ $product->created_at }}</td>          
          </tr>

          <tr>           
              <td scope="row">updated_at</th>
              <td>{{ $product->updated_at }}</td>          
          </tr>
   
      </tbody>
  </table>
  <p><a href="/products/{{ $product->id }}/edit" class="btn btn-info">Edit</a></p>
  <form action="/products/{{ $product->id }}" method="post">
    @method('DELETE')
    @csrf
    <button type="submit" class="btn btn-danger">Delete</button>
  </form>
</div>
</div>
</div>
@endsection