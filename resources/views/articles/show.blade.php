@extends('layouts.admin')

@section('title', $article->title)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table table-bordered table-dark">
              <thead>
                <tr>
                  <th scope="col">id</th>
                  <th scope="col">{{ $article->id }}</th>
                 
              </tr>
          </thead>
          <tbody>
          
            <tr>           
              <td scope="row">title</th>
              <td>{{ $article->title }}</td>          
          </tr>

          <tr>           
              <td scope="row">content</th>
              <td>{!! $article->content !!}</td>          
          </tr>

          <tr>           
              <td scope="row">image</th>
              <td>@if($article->image)
                <img src="{{ asset('storage/' . $article->image) }}" alt="photo" class="img-thumbnail"></td>
                @endif       
          </tr>

          <tr>           
              <td scope="row">status</th>
              <td>{{ $article->status }}</td>          
          </tr>

          <tr>           
              <td scope="row">viewed</th>
              <td>{{ $article->viewed }}</td>          
          </tr>

          <tr>           
              <td scope="row">User</th>
              
              <td>{{ $article->user ? $article->user->name : '' }}</td>     
          </tr>

          <tr>           
              <td scope="row">Category</th>
              <td>{{ $article->category->title }}</td>          
          </tr>

          <tr>           
              <td scope="row">Tags</th>
               <td> @foreach($article->tags as $tags)
              {{ $tags->title . "," }}
              @endforeach  </td>        
          </tr>

          <tr>           
              <td scope="row">created_at</th>
              <td>{{ $article->created_at }}</td>          
          </tr>

          <tr>           
              <td scope="row">updated_at</th>
              <td>{{ $article->updated_at }}</td>          
          </tr>
   
      </tbody>
  </table>
  <p><a href="/articles/{{ $article->id }}/edit" class="btn btn-info">Edit</a></p>
  <form action="/articles/{{ $article->id }}" method="post">
    @method('DELETE')
    @csrf
    <button type="submit" class="btn btn-danger">Delete</button>
  </form>
</div>
</div>
</div>
@endsection