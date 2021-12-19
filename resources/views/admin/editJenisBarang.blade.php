@extends('layout/layout')
@section('content')
<div class="account-container register">
	<div class="content clearfix">
		<form action="{{ url('/jenisBarang/update/' .Crypt::encrypt($data1->id)) }}" method="post">
        @csrf
			<h2>Form Jenis Barang</h2>			
			<div class="login-fields span12">
				<p>Edit data jenis barang:</p>
                <div class="login-fields">
                    <input type="text" id="jenis_barang" name="jenis_barang" placeholder="Jenis Barang" class="login-field" value="{{ $data1->jenis_barang }}" required oninvalid="this.setCustomValidity('Insert Jenis Barang Here!')" oninput="this.setCustomValidity('')" />
                    @error('jenis_barang')<div class="invallid-feedback text-danger">*{{$message}}</div> @enderror
                </div><br>
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