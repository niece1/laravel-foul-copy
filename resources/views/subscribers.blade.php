@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-md-offset-1">
            <table class="table table-striped table-dark">
              <thead>
                <tr>
                  <td>id</th>
                  <td>email</th>
                  <td>date</th>
                  
              </tr>
          </thead>
          <tbody>
            @foreach ($subscribers as $subscriber)
            <tr>
            
              <td>{{ $subscriber->id }}</th>
              <td>{{ $subscriber->email }}</td>
              <td>{{ $subscriber->created_at }}</td>
              
          </tr>
          @endforeach
      </tbody>
  </table>
</div>
</div>
</div>
@endsection