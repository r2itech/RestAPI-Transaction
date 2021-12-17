@extends('layout/layout')
@section('content')
<div class="container">
    <div class="row">
	    <div class="span12">
	      	<div class="widget">
	      	    <div class="widget-content">
					<div class="widget-header">
						<i class="icon-pushpin"></i>
						<h3>Application Programming Interface</h3>
					</div> <!-- /widget-header -->
					<div class="widget-content">
					<h3>Your Token: {{ $token }}</h3><br>
					<ol class="faq-list">
						<li>
							<h4>Cara menggunakan API</h4>
							<p>Kirimkan token anda setiap kali anda melakukan request ke API</p>
						</li>
						<li>
							<h4>URL API Data Transaksi</h4>
							<p>{{ url('/') }}/api/get-transaksi</p>
						</li>
						<li>
							<h4>URL API Data Barang</h4>
							<p>{{ url('/') }}/api/get-barang</p>
						</li>
						<li>
							<h4>URL API Data Jenis Barang</h4>
							<p>{{ url('/') }}/api/get-jenis-barang</p>
						</li>
					</ol>
				</div> <!-- /widget-content -->	
			</div> <!-- /widget -->	
		</div> <!-- /spa12 -->
	</div> <!-- /row -->
</div> <!-- /container -->
<?php
    for($i=1; $i<=10; $i++){
        echo '<br>';
    }
?>
@endsection