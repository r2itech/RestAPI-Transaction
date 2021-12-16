@extends('layout/layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-9">
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
                    <h2>Daftar Transaksi</h2><br>
                </div>
            </div>
            <table class="table table-striped table-bordered" id="transaksi">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jenis Barang</th>
                        <th>Tanggal Transaksi</th>
                        <th>Jumlah Terjual</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('datatable')
<script type="text/javascript">
    $(document).ready(function() {
        $('#transaksi').DataTable({
            processing : true,
            serverSide : true,
            ajax : {
                url : "{{ url('/') }}",
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
                {data:'nama_barang',name:'nama_barang'},
                {data:'jenis_barang',name:'jenis_barang'},
                {data:'tgl_transaksi',name:'tgl_transaksi'},
                {data:'jumlah',name:'jumlah'},
                {data:'stok',name:'stok'},
            ],
            order: [[3,'desc']]
        });
    });
</script>
@stop