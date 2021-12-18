@extends('layout/layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            @if(session('warning'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Warning!</strong> {{ session('warning') }}
            </div>
            @elseif(session('info'))
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Info!</strong> {{ session('info') }}
            </div>
            @endif
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-12">
                    <h2>Data Pengguna API</h2><br>
                </div>
            </div>
            <table class="table table-striped table-bordered" id="user">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Token API</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
    for($i=1; $i<=7; $i++){
        echo '<br>';
    }
?>
@endsection

@section('datatable')
<script type="text/javascript">
    $(document).ready(function() {
        $('#user').DataTable({
            processing : true,
            serverSide : true,
            ajax : {
                url : "{{ url('/api/' .Crypt::encrypt('api')) }}",
                type : 'GET'
            },
            columns: [
                {  
                    "data": null,
                    "class": "align-top",
                    "orderable": false,
                    "searchable": false,
                    "render": function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data:'name',name:'name'},
                {data:'email',name:'email'},
                {data:'api_token',name:'api_token'},
                {data:'aksi',name:'aksi'},
            ],
            order: [[1,'asc']]
        });
    });

    function myFunction() {
      if(!confirm("Apakah anda serius akan menghapus data pengguna ini?"))
      event.preventDefault();
  }
</script>
@stop