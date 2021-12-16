@extends('layout/layout')
@section('content')
<div class="account-container">
	<div class="content clearfix">
		<form action="{{ url('/login') }}" method="post">
            @csrf
			<h1>Login</h1>		
			<div class="login-fields">
                @if(session('warning'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Warning!</strong> {{ session('warning') }}
                </div>
                @elseif(session('info'))
                <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Info!</strong> {{ session('info') }}
                </div>
                @endif
				<div class="field">
					<label for="email">Email</label>
					<input type="email" id="email" name="email" placeholder="Email" class="login username-field" autocomplete="off" required oninvalid="this.setCustomValidity('Insert Email Here!')" oninput="this.setCustomValidity('')" />
				</div> <!-- /field -->
				<div class="field">
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" placeholder="Password" class="login password-field" required oninvalid="this.setCustomValidity('Insert Password Here!')" oninput="this.setCustomValidity('')">
				</div> <!-- /password -->				
			</div> <!-- /login-fields -->			
			<div class="login-actions">
                <span class="login-checkbox">
                    <a href="{{ url('/register/' .Crypt::encrypt('register')) }}" title="Resgister"><i class="icon-info-sign"></i> Don't have an account? </a>
				</span>	
				<button type="submit" class="button btn btn-success btn-large">Login</button>				
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