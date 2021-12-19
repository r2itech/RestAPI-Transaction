@extends('layout/layout')
@section('content')
<div class="account-container register">
	<div class="content clearfix">
		<form action="{{ url('/transaksi/create') }}" method="post">
        @csrf
			<h2>Form Transaksi</h2>			
			<div class="login-fields span12">
				<p>Tambah data transaksi:</p>
				<div class="login-fields">
					<select class="login" id="barang" name="barang" required oninvalid="this.setCustomValidity('Select this option!')" oninput="this.setCustomValidity('')">
                        <option selected value="" readonly disabled>--- Pilih barang --</option>
                        @foreach($data as $d)
                        <option value="{{ $d->id }}">{{ $d->nama_barang }}</option>
                        @endforeach
                    </select>
				</div>
			</div>
			<div class="login-fields">
				<button type="submit" class="button btn btn-primary btn-mini">Submit</button>
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