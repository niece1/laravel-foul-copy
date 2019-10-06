@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <table class="table table-striped table-dark">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">title</th>
            <th scope="col">content</th>
            <th scope="col">image</th>
            <th scope="col">status</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($articles as $article)
          <tr>           
            <th scope="row">{{ $article->id }}</th>
            <td><a href="/articles/{{ $article->id }}">{{ $article->title }}</a></td>
            <td>{{ $article->content }}</td>
            <td>
              @if($article->image)
              <img src="{{ asset('storage/' . $article->image) }}" alt="photo" class="img-thumbnail">
            @endif
          </td>
            <td>{{ $article->status }}</td>             
            <td><a href="/articles/{{ $article->id }}/edit" class="btn btn-info">Edit</a></td>
            <td>
              <form action="/articles/{{ $article->id }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>             
          </tr>
          @endforeach
        </tbody>
      </table>
      <a href="{{route('articles.create')}}" class="btn btn-success">Create</a>
    </div>
  </div>

  <div class="row">
    <div class="col-12 d-flex justify-content-center pt-3">
      {{ $articles->links() }}
    </div>
  </div>

</div>
@endsection