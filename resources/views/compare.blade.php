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
                <div class="col-12 col-md-7">
                    <h3>Perbandingan Transaksi</h3><br>
                    @if($from == null && $until == null)
                    <h4>Semua Transaksi</h4><br>
                    @else
                    <h4>Dari tanggal: {{ date('d-m-Y', strtotime($from)) }} - Sampai Tanggal: {{ date('d-m-Y', strtotime($until)) }}</h4><br>
                    @endif
                </div>
                <div class="col-12 col-md-5">
                    <form method="post" action="{{ url('/compare/' .Crypt::encrypt('compare')) }}">
                        @csrf
                            <div class="field">
                                <input type="date" value="{{ $from }}" id="from" name="from" style="height: 30px; margin-bottom: 0px;"  required oninvalid="this.setCustomValidity('Insert Start Date Here!')" oninput="this.setCustomValidity('')">   
                                <input type="date" value="{{ $until }}" id="until" name="until" style="height: 30px; margin-bottom: 0px;"  required oninvalid="this.setCustomValidity('Insert End Date Here!')" oninput="this.setCustomValidity('')">   
                                <button type="submit" style="margin-top: 0px;" class="btn btn-info btn-small"><i class="icon-filter"></i></button>
                            </div>
                    </form>
                </div>
            </div>
            <table class="table table-striped table-bordered" id="compare">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Jenis Barang</th>
                        <th>Jumlah Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jenis_barang as $key => $j)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $j->jenis_barang }}</td>
                        <td>
                            <?php
                                $jum = (!empty($data[$key])) ? $data[$key]->jumlah : 0;
                                echo $jum;
                            ?>
                        </td>    
                    </tr>
                    @endforeach
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
        $('#compare').DataTable({
            searching  : false,
            paging : false,
            // ordering : true,
            info : true,
            "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [ 0, 1 ] }
            ]
        });
    });
</script>
@stop