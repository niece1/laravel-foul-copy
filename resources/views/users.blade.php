@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-md-offset-1">
            <table class="table table-striped table-dark">
              <thead>
                <tr>
                  <td>id</th>
                  <td>name</th>
                  <td>email</th>
                  <td>created_at</th>
                  <td>updated_at</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>
            
              <td>{{ $user->id }}</th>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->created_at }}</td>
              <td>{{ $user->updated_at }}</td>
          </tr>
          @endforeach
      </tbody>
  </table>
</div>
</div>
</div>
@endsection