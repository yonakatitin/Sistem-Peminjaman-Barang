
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Admin | Albums</title>
    <meta name="description" content="This is the description">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login-register.css') }}">
</head>

<body>
    <div class="form">

        <ul class="tab-group">
            <li class="tab "><a href="#login" class="login" style="border-radius: 0 0 0 0; width:100%; margin-left: -30px;">Reset Password</a></li>
        </ul>

            <div id="login">

                  @if (session('success'))
                      <div class="alert alert-success" style="color: green; margin-left: 20px;">
                        {{ session('success') }}
                      </div>
                  @endif

                <form action="{{ route('forget.password.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="field-wrap">
                        <label for="email">
                            Email Address<span class="req">*</span>
                        </label>
                        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" required autofocus />
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                        
                    </div>
                    
                    <button class="button button-block" type="submit" name="login" id="login-btn">Send Password Reset Link</button>

                </form>

            </div>

        </div><!-- tab-content -->

    </div> <!-- /form -->
</body>
<script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
<script src="{{ asset('js/login-register.js') }}"></script>

</html>