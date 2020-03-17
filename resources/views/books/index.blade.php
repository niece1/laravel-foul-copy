@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Book name</th>
            <th scope="col">Price</th> 
          <!--  <th scope="col">Price EUR</th>   -->                
          </tr>
        </thead>
        <tbody>
          @forelse ($books as $book)
          <tr>           
            <td scope="row">{{ $book->name }}</td>
            <td>{{ $book->price }}</td>
        <!--    <td>{{ $book->price_eur }}</td> -->
          </tr>
          @empty
          <tr>
           <td colspan="2">No books found</td>
         </tr>
         @endforelse
       </tbody>
     </table>
     {{ $books->links() }}
   </div>
 </div>

</div>
@endsection