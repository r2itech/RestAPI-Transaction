@extends('layout/layout')
@section('content')
<div class="container">
	<div class="row">
		<div class="span12">
			<div class="error-container">
				<h1>404</h1>
				<h2>Pages Not Found!</h2>
				<div class="error-details">
					Sorry, page not found! Why not try going back to the <a href="{{ url('/') }}">home page</a> or perhaps try following!
				</div> <!-- /error-details -->
				<div class="error-actions">
					<a href="{{ url('/') }}" class="btn btn-large btn-primary">
						<i class="icon-chevron-left"></i>
						&nbsp;
						Back to Home						
					</a>
				</div> <!-- /error-actions -->		
			</div> <!-- /error-container -->						
		</div> <!-- /span12 -->		
	</div> <!-- /row -->	
</div> <!-- /container -->
@endsection