<!--login form popup-->
<div class="login-wrapper" id="login-content">
    <div class="login-content">
        <a href="#" class="close">x</a>
        <h3>Login</h3>
        <form method="post" action="{{ route('user.login') }}">
            @csrf
        	<div class="row">
        		 <label for="username">
                    Username:
                    <input type="text" name="username" id="username" placeholder="" required="required" />
                </label>
                @error('username')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
        	</div>
            <div class="row">
            	<label for="password">
                    Password:
                    <input type="password" name="password" id="password" placeholder="******" required="required" />
                </label>
                @error('password','loginErrors')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
                @error('invalid','loginErrors')
                    <div class="alert alert-danger">{{$message}}</div>
                 @enderror
            </div>
            <div class="row">
            	<div class="remember">
					<div>
						<input type="checkbox" name="remember" value="Remember me"><span>Remember me</span>
					</div>
            		<a href="#">Forget password ?</a>
            	</div>
            </div>
           <div class="row">
           	 <button type="submit">Login</button>
           </div>
        </form>
        <div class="row">
        	<p>Don't have an account? Sign up <a class="signupLink" href="#" style="text-decoration: underline" >here</a></p>
        </div>
    </div>
</div>
<!--end of login form popup-->
<!--signup form popup-->
<div class="login-wrapper"  id="signup-content">
    <div class="login-content">
        <a href="#" class="close">x</a>
        <h3>sign up</h3>
        <form method="post" action="{{ route('user.register') }}">
            @csrf
            <div class="row">
                 <label for="username-2">
                    Username:
                    <input type="text" name="username" id="username-2" placeholder="" required/>
                </label>
                @error('username','signupErrors')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
           
            <div class="row">
                <label for="email-2">
                    Your email:
                    <input type="email" name="email" id="email-2" placeholder="" required/>
                </label>
                @error('email','signupErrors')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
             <div class="row">
                <label for="password-2">
                    Password:
                    <input type="password" name="password" id="password-2" placeholder="" required/>
                </label>
            </div>
             <div class="row">
                <label for="repassword-2">
                    Confirm Password:
                    <input type="password" name="password_confirmation" id="repassword-2" placeholder="" required/>
                </label>
            </div>
            @error('password','signupErrors')
                    <div class="alert alert-danger">{{$message}}</div>
            @enderror
           <div class="row">
             <button type="submit">sign up</button>
           </div>
           <div class="row">
        	<p>Already have an account? Log in <a class="loginLink" href="#" style="text-decoration: underline" >here</a></p>
            </div>
        </form>
    </div>
</div>