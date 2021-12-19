@extends('layout/layout')
@section('content')
<div class="account-container register">
	<div class="content clearfix">
		<form action="{{ url('/barang/update/' .Crypt::encrypt($data1->id)) }}" method="post">
        @csrf
			<h2>Form Barang</h2>			
			<div class="login-fields span12">
				<p>Edit data barang:</p>
				<div class="login-fields">
					<select class="login" id="jenis_barang" name="jenis_barang" required oninvalid="this.setCustomValidity('Select this option!')" oninput="this.setCustomValidity('')">
                        <option value="" readonly disabled>--- Pilih jenis barang --</option>
                        @foreach($data as $d)
                        @if($d->id == $data1->id_jenis_barang)
                        <option selected value="{{ $d->id }}">{{ $d->jenis_barang }}</option>
                        @else
                        <option value="{{ $d->id }}">{{ $d->jenis_barang }}</option>
                        @endif
                        @endforeach
                    </select>
				</div><br>
                <div class="login-fields">
                    <input type="text" id="nama_barang" name="nama_barang" placeholder="Nama Barang" class="login-field" value="{{ $data1->nama_barang }}" required oninvalid="this.setCustomValidity('Insert Nama Barang Here!')" oninput="this.setCustomValidity('')" />
                </div><br>
                <div class="login-fields">
                    <input type="number" id="stok" name="stok" placeholder="Stok Barang" class="login-field" value="{{ $data1->stok }}" required oninvalid="this.setCustomValidity('Insert Stok Here!')" oninput="this.setCustomValidity('')" />
                </div>
			</div>
			<div class="login-fields">
				<button type="submit" class="button btn btn-primary btn-mini">Update</button>
			</div> <!-- .actions -->
		</form>
	</div> <!-- /content -->
</div> <!-- /account-container -->
<?php
    for($i=1; $i<=9; $i++){
        echo '<br>';
    }
?>
@endsection