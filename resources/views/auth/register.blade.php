
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Barang UNS</title>
    <meta name="description" content="This is the description">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login-register.css') }}">
</head>

<body>
    <div class="form">

        <ul class="tab-group" style="margin-left: 205px;">
            <li class="tab "><a href="#signup" class="signup">User Sign Up</a></li>
            <li class="tab active"><a href="#login" class="login">Log In</a></li>
        </ul>

        <div class="tab-content">
            <div id="signup">
                <h1><b>User Sign Up for Free</b></h1>

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="field-wrap">
                        <label for="name">
                            Name<span class="req">*</span>
                        </label>
                        <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field-wrap">
                        <label for="number">
                            Phone Number<span class="req">*</span>
                        </label>
                        <input id="no_hp" type="text" class=" @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}" required autocomplete="no_hp" autofocus>

                        @error('no_hp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field-wrap">
                        <label for="address">
                            Address<span class="req">*</span>
                        </label>
                        <input id="alamat" type="text" class=" @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat" autofocus>

                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field-wrap">
                        <label for="email">
                            Email Address<span class="req">*</span>
                        </label>
                        <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field-wrap">
                        <label for="pass">
                            Password<span class="req">*</span>
                        </label>
                        <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field-wrap">
                        <label for="confirmpass">
                            Confirm Password<span class="req">*</span>
                        </label>
                        <input id="password-confirm" type="password" class="" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <button type="submit" name="signup" class="button button-block">Get Started</button>

                </form>

            </div>

                        

            <div id="login">
                <h1><b>Welcome Back!</b></h1>

                <form method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="field-wrap">
                        <label for="email">
                            Email Address<span class="req">*</span>
                        </label>
                        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field-wrap">
                        <label for="pass">
                            Password<span class="req">*</span>
                        </label>
                        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required />
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <p class="forgot"><a href="{{ route('forget.password.get') }}">Forgot Password?</a></p>

                    <button class="button button-block" type="submit" name="login" id="login-btn">Log In</button>

                </form>

            </div>

        </div><!-- tab-content -->

    </div> <!-- /form -->
</body>
<script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
<script src="{{ asset('js/login-register.js') }}"></script>

</html>



