@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <table class="table table-striped table-dark">
        <thead>
          <tr>
            <th>id</th>
            <th>title</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $category)
          <tr>           
            <td>{{ $category->id }}</td>
            <td>{{ $category->title }}</td>
            
            <td>
              <form action="/categories/{{ $category->id }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>                     
          </tr>
          @endforeach
        </tbody>
      </table>
      <a href="{{route('categories.create')}}" class="btn btn-success">Create</a>
    </div>
  </div>
</div>
@endsection