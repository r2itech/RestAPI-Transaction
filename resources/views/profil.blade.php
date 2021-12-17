@extends('layout/layout')
@section('content')
<div class="account-container register">
	<div class="content clearfix">
		<form action="{{ url('/profil/update/' .Crypt::encrypt($data1->id)) }}" method="post">
		@csrf
			<h1>Profile</h1>			
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
					<input type="email" value="{{ $data1->email }}"class="login" disabled />
				</div>
				<div class="field">
					<input type="text"value="{{ $data1->name }}" class="login" disabled />
				</div>
				<div class="field">
					<input type="password" id="old_password" name="old_password" placeholder="old Password" class="login" maxlength="16" required oninvalid="this.setCustomValidity('Insert old_password Here!')" oninput="this.setCustomValidity('')" />
					@error('old_password')<div class="invallid-feedback text-danger">*{{$message}}</div> @enderror
				</div>
                <div class="field">
					<input type="password" id="password" name="password" placeholder="New Password: min 5, max 16 character" class="login" maxlength="16" required oninvalid="this.setCustomValidity('Insert Password Here!')" oninput="this.setCustomValidity('')" />
					@error('password')<div class="invallid-feedback text-danger">*{{$message}}</div> @enderror
				</div>
				<div class="field">
					<input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm New Password" class="login" maxlength="16" required oninvalid="this.setCustomValidity('Confirm Password Here!')" oninput="this.setCustomValidity('')" />
					@error('confirm_password')<div class="invallid-feedback text-danger">*{{$message}}</div> @enderror
				</div>
			</div>
			<div class="login-actions">
				<button type="submit" class="button btn btn-primary btn-large">Update</button>
				
			</div> <!-- .actions -->
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->
@endsection