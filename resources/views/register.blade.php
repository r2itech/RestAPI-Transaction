@extends('layout/layout')
@section('content')
<div class="account-container register">
	<div class="content clearfix">
		<form action="{{ url('/register') }}" method="post">
		@csrf
			<h1>Register for Free Account</h1>			
			<div class="login-fields">
				<p>Create your free account:</p>
				<div class="field">
					<input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Full Name" class="login" required oninvalid="this.setCustomValidity('Insert Name Here!')" oninput="this.setCustomValidity('')" />
				</div>
				<div class="field">
					<input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email" class="login" required oninvalid="this.setCustomValidity('Insert Email Here!')" oninput="this.setCustomValidity('')" />
					@error('email')<div class="invallid-feedback text-danger">*{{$message}}</div> @enderror
				</div>
				<div class="field">
					<input type="password" id="password" name="password" placeholder="Password: min 5, max 16 character" class="login" maxlength="16" required oninvalid="this.setCustomValidity('Insert Password Here!')" oninput="this.setCustomValidity('')" />
					@error('password')<div class="invallid-feedback text-danger">*{{$message}}</div> @enderror
				</div>
				<div class="field">
					<input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="login" maxlength="16" required oninvalid="this.setCustomValidity('Confirm Password Here!')" oninput="this.setCustomValidity('')" />
					@error('confirm_password')<div class="invallid-feedback text-danger">*{{$message}}</div> @enderror
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