@extends('layout/layout')
@section('content')
<div class="account-container register">
	<div class="content clearfix">
		<form action="{{ url('/barang/create') }}" method="post">
        @csrf
			<h2>Form Barang</h2>			
			<div class="login-fields span12">
				<p>Tambah data barang:</p>
				<div class="login-fields">
					<select class="login" id="jenis_barang" name="jenis_barang" required oninvalid="this.setCustomValidity('Select this option!')" oninput="this.setCustomValidity('')">
                        <option selected value="" readonly disabled>--- Pilih jenis barang --</option>
                        @foreach($data as $d)
                        <option value="{{ $d->id }}">{{ $d->jenis_barang }}</option>
                        @endforeach
                    </select>
				</div><br>
                <div class="login-fields">
                    <input type="text" id="nama_barang" name="nama_barang" placeholder="Nama Barang" class="login-field" required oninvalid="this.setCustomValidity('Insert Nama Barang Here!')" oninput="this.setCustomValidity('')" />
                </div><br>
                <div class="login-fields">
                    <input type="number" id="stok" name="stok" placeholder="Stok Barang" class="login-field" required oninvalid="this.setCustomValidity('Insert Stok Here!')" oninput="this.setCustomValidity('')" />
                </div>
			</div>
			<div class="login-fields">
				<button type="submit" class="button btn btn-primary btn-mini">Submit</button>
			</div> <!-- .actions -->
		</form>
	</div> <!-- /content -->
</div> <!-- /account-container -->
@endsection