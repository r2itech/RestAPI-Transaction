@extends('layout/layout')
@section('content')
<div class="account-container register">
	<div class="content clearfix">
		<form action="{{ url('/register') }}" method="post">
			<h1>Register for Free Account</h1>			
			<div class="login-fields">
				<p>Create your free account:</p>
				<div class="field">
					<input type="text" id="name" name="name" value="" placeholder="Full Name" class="login" />
				</div>
				<div class="field">
					<input type="text" id="email" name="email" value="" placeholder="Email" class="login"/>
				</div>
				<div class="field">
					<input type="password" id="password" name="password" value="" placeholder="Password" class="login"/>
				</div>
				<div class="field">
					<input type="password" id="confirm_password" name="confirm_password" value="" placeholder="Confirm Password" class="login"/>
				</div>
			</div>
			<div class="login-actions">
                <span class="login-checkbox">
                    <a href="{{ url('/login/' .Crypt::encrypt('login')) }}" title="Resgister"><i class="icon-info-sign"></i> Already have an account? Login now</a>
				</span>	
				<button type="submit" class="button btn btn-primary btn-large">Submit</button>
				
			</div> <!-- .actions -->
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->
@endsection