@extends('layout/layout')
@section('content')
<div class="account-container register">
	<div class="content clearfix">
		<form action="{{ url('/transaksi/update/' .Crypt::encrypt($data1->id)) }}" method="post">
        @csrf
			<h2>Form Transaksi</h2>			
			<div class="login-fields span12">
				<p>Edit data transaksi:</p>
				<div class="login-fields">
					<select class="login" id="barang" name="barang" required oninvalid="this.setCustomValidity('Select this option!')" oninput="this.setCustomValidity('')">
                        <option value="" readonly disabled>--- Pilih barang --</option>
                        @foreach($data as $d)
                        @if($d->id == $data1->id_barang)
                        <option selected value="{{ $d->id }}">{{ $d->nama_barang }}</option>
                        @else
                        <option value="{{ $d->id }}">{{ $d->nama_barang }}</option>
                        @endif
                        @endforeach
                    </select>
				</div>
			</div>
			<div class="login-fields">
				<button type="submit" class="button btn btn-primary btn-mini">Update</button>
			</div> <!-- .actions -->
		</form>
	</div> <!-- /content -->
</div> <!-- /account-container -->
<?php
    for($i=1; $i<=7; $i++){
        echo '<br>';
    }
?>
@endsection