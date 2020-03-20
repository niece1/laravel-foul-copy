@extends('layouts.app')

@section('extra-css')
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <table class="table" id="customers-table">
        <thead>
          <tr>
            <th scope="col">First name</th>
            <th scope="col">Last name</th> 
            <th scope="col">Email</th>
            <th scope="col"></th>               
          </tr>
        </thead>
        <tbody>
    
       </tbody> 
     </table>

   </div>
 </div>

</div>
@endsection

@section('extra-js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
    <script type="text/javascript">
       $(document).ready( function() {
    $('#customers-table').DataTable({
      /*To override names of filter and search, i18n
      "language": {
        "lengthMenu": "Display _MENU_ entries per page",
        "search": "Search for: ",
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Russian.json"
      },*/
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('get.customers') }}",
        "columns": [
          
            { "data": "first_name" },
            { "data": "last_name" },
            { "data": "email" },
            { "data": "" }
            
        ],
        "pageLength": 100,/*to set default entries*/
        "lengthMenu": [10, 50, 100],
         /*to disable show entry select
          'dom': 'frtip',
        */
        /* To concatenate first end second columns
        "columnDefs": [
        {
          "render": function (data, type, row) {
            return data +' '+row['last_name'];
          },
          "targets":0
        },
        {"visible":false, "targets":[ 1 ]}
        ]*/
        /*first we filter by last name and then by first name
        "order": [[1, 'asc'], [0, 'asc']]*/
        /*-1 means last */
        "columnDefs": [
        {
          targets:-1,
          render: function (data, type, row) {
            return '<a class="btn btn-xs btn-info" href="/{{ request()->segment(1) }}/' + row['id']+'/edit">Edit</a> ' +
            '<form action="/{{ request()->segment(1) }}/' + row['id']+'/delete" method="POST" style="display:inline">' +
            '<input type="hidden" name="_method" value="DELETE">' +
            '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
            '<input type="submit" class="btn btn-xs btn-danger" value="DELETE">' +
            '</form>';
          },
        }]
    });
});
    </script>
@endsection