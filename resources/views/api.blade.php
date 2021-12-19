@extends('layout/layout')
@section('content')
<div class="container">
    <div class="row">
	    <div class="span12">
	      	<div class="widget">
	      	    <div class="widget-content">
					<div class="widget-header">
						<i class="icon-cog"></i>
						<h3>Application Programming Interface</h3>
					</div> <!-- /widget-header -->
					<div class="widget-content">
						<h3>Your Token:</h3>
						<input type="text" value="{{ $token }}" id="token" name="token" style="height: 30px; margin-bottom: 0px;" readonly />
        				<button type="button" onclick="copy()" title="Copy to Clipboard" class="btn btn-info btn-small"><i class="icon-copy"></i></button>
					<br>
					<br>
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
<div id="snackbar">Token dicopy ke clipboard</div>
@endsection

@section('copy')
<script type="text/javascript">
    function copy() {
        document.getElementById("token").select();
        document.execCommand("copy");

		var x = document.getElementById("snackbar");

		x.className = "show";

		setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }
</script>

<style type="text/css">
	/* The snackbar - position it at the bottom and in the middle of the screen */
	#snackbar {
		visibility: hidden; /* Hidden by default. Visible on click */
		min-width: 250px; /* Set a default minimum width */
		margin-left: -125px; /* Divide value of min-width by 2 */
		background-color: #333; /* Black background color */
		color: #fff; /* White text color */
		text-align: center; /* Centered text */
		border-radius: 2px; /* Rounded borders */
		padding: 16px; /* Padding */
		position: fixed; /* Sit on top of the screen */
		z-index: 1; /* Add a z-index if needed */
		left: 50%; /* Center the snackbar */
		bottom: 30px; /* 30px from the bottom */
	}

	/* Show the snackbar when clicking on a button (class added with JavaScript) */
	#snackbar.show {
		visibility: visible; /* Show the snackbar */
		/* Add animation: Take 0.5 seconds to fade in and out the snackbar.
		However, delay the fade out process for 2.5 seconds */
		-webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
		animation: fadein 0.5s, fadeout 0.5s 2.5s;
	}

	/* Animations to fade the snackbar in and out */
	@-webkit-keyframes fadein {
		from {bottom: 0; opacity: 0;}
		to {bottom: 30px; opacity: 1;}
	}

	@keyframes fadein {
		from {bottom: 0; opacity: 0;}
		to {bottom: 30px; opacity: 1;}
	}

	@-webkit-keyframes fadeout {
		from {bottom: 30px; opacity: 1;}
		to {bottom: 0; opacity: 0;}
	}

	@keyframes fadeout {
		from {bottom: 30px; opacity: 1;}
		to {bottom: 0; opacity: 0;}
	}
</style>
@stop