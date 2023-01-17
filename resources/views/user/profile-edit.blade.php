@extends('layouts.template')
@section('content')
<div class="hero user-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1 style="margin-left:-350px;">{{ $username }}’s profile</h1>
					<ul class="breadcumb">
						<li class="active"><a href="{{ route('home') }}">Home</a></li>
						<li> <span class="ion-ios-arrow-right"></span>Edit Profile</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="page-single">
	<div class="container">
		<div class="row ipad-width">
			<div class="col-md-3 col-sm-12 col-xs-12">
				<div class="user-information">
					<div class="user-img">
						<a href="#"><img src="images/uploads/user-img.png" alt=""><br></a>
						<a href="#" class="redbtn">Change avatar</a>
					</div>
					<div class="user-fav">
						<p>Account Details</p>
						<ul>
							<li  class="active"><a href="{{ route('user.profile-edit') }}">Profile</a></li>
							<li><a href="{{ route('user.profile') }}">Favorite movies</a></li>
						</ul>
					</div>
					<div class="user-fav">
						<p>Others</p>
						<ul>
							<li><a href="{{ route('user.logout') }}">Log out</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9 col-sm-12 col-xs-12">
                <div class="row">
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                </div>
				<div class="form-style-1 user-pro" action="#">
					<form method="post" action="{{ route('user.profile-edit') }}" class="user">
                        @csrf
						<h4>01. Profile details</h4>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Username</label>
								<input name="name" type="text" value="{{ $username }}" required>
							</div>
						</div>
                        @if(!$errors->profileErrors->isEmpty())
                            <div class="row">
                            @foreach($errors->profileErrors->all() as $error)
                                <div class="col-md-6 alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                            </div>
                        @endif
						<div class="row">
							<div class="col-md-2">
								<input class="submit" type="submit" value="save">
							</div>
						</div>	
					</form>
                    <form method="post" action="{{ route('user.profile-edit') }}" class="user">
                        @csrf
						<h4>02. Change Email</h4>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Email Address</label>
								<input name="email" type="email" value="{{ $email }}" required>
							</div>
						</div>
                        @if(!$errors->emailErrors->isEmpty())
                            <div class="row">
                            @foreach($errors->emailErrors->all() as $error)
                                <div class="col-md-6 alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                            </div>
                        @endif
						<div class="row">
							<div class="col-md-2">
								<input class="submit" type="submit" value="save">
							</div>
						</div>	
					</form>
					<form method="post" action="{{ route('user.profile-edit') }}" class="password">
                        @csrf
						<h4>03. Change password</h4>
						<div class="row">
						</div>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>New Password</label>
								<input name="password" type="password">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Confirm New Password</label>
								<input name="password_confirmation" type="password">
							</div>
						</div>
                        @if(!$errors->passwordErrors->isEmpty())
                            <div class="row">
                            @foreach($errors->passwordErrors->all() as $error)
                                <div class="col-md-6 alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                            </div>
                        @endif
						<div class="row">
							<div class="col-md-2">
								<input class="submit" type="submit" value="change">
							</div>
						</div>	
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection