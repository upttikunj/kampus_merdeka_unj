<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
  <title>SIMERDEKA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href={{ asset("plugins/fontawesome-free/css/all.min.css") }}>
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href={{ asset("plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}>
  <!-- Theme style -->
  <link rel="stylesheet" href={{ asset("dist/css/adminlte.min.css") }}>

  <style>
    html,
    body {
      /* background-image: url('img/black.jpg'); */
      /* background-image: url('https://source.unsplash.com/1600x900/?nature'); */
      background: rgb(0, 143, 145);
      background: linear-gradient(90deg, rgba(0, 143, 145, 1) 0%, rgba(0, 143, 145, 1) 0%, rgba(43, 152, 162, 1) 43%, rgba(0, 143, 145, 1) 100%, rgba(0, 143, 145, 1) 100%);
      background-size: cover;
      background-repeat: no-repeat;
      height: 100vh;

    }

    .container {
      height: 100%;
      align-content: center;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="d-flex flex-column justify-content-center align-items-center mb-2">
        <img src="{{ asset('img/logo_unj_green_small.png') }}" width="auto" height="250" />
    </div>

    <div class="card-header text-center">
      <a href="/login" class="h1"><b>SIMERDEKA</b>UNJ</a>
    </div>
    <div class="card-body">
      {{-- <p class="login-box-msg"><b>Login</b></p> --}}

      <form action="{{ route('login.attemptLogin') }}" method="post">
        @csrf

        <div class="input-group mb-3">
          <input type="text" name="username" id="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" id="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="text-sm text-danger" style="font-size:12px;">
                @if (session('login_msg'))
                    {!! session('login_msg') !!}
                @endif
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      {{-- <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> --}}
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      {{-- <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> --}}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src={{ asset("plugins/jquery/jquery.min.js") }}></script>
<!-- Bootstrap 4 -->
<script src= {{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js") }}></script>
<!-- AdminLTE App -->
<script src={{ asset("dist/js/adminlte.min.js") }}></script>
</body>
</html>
