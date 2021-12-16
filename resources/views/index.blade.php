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
        <div class="col-10">
            <h1 class="mt-3">Daftar Transaksi</h1>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Jenis Barang</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Jumlah Terjual</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi as $t)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{ $t->barang->nama_barang }}</td>
                        <td>{{ $t->barang->jenisBarang->jenis_barang }}</td>
                        <td>{{ $t->tanggal_transaksi }}</td>
                        <td>{{ $t->jumlah }}</td>
                        <td>{{ $t->barang->stok }}</td>
                        <td>
                            <a href="#" class="badge badge-primary">Edit</a>
                            <a href="#" class="badge badge-danger">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection