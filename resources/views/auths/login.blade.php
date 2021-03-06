<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
    <title>Trustmedis HIS - Login</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{asset('admin/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/linearicons/style.css')}}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('admin/assets/css/main.css')}}">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="{{asset('admin/assets/css/demo.css')}}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('admin/assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('admin/assets/img/favicon.ico')}}">
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle">
                <div class="auth-box ">
                    <div class="left">
                        <div class="content">
                            <div class="header">
                                <div class="logo text-center"><img src="{{asset('logo-tm.png')}}" alt="Klorofil Logo">
                                </div>
                                {{-- <p class="lead">Login</p> --}}
                            </div>
                            @if(session('error'))							
							<div class="alert alert-danger alert-dismissible" role="alert">
								{{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button> --}}
								<i class="fa fa-times-circle"></i> {{session('error')}}
							</div>
                            @endif
                            <form class="form-auth-small" action="/postlogin" method="POST">
                                {{-- @method('POST') --}}
                                @csrf
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Email</label>
                                    <input type="text" name="name" autofocus="true" class="form-control"
                                        id="signin-email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" name="password" class="form-control" id="signin-password"
                                        placeholder="Password">
                                </div>
                                <div class="form-group clearfix">
                                    {{-- <label class="fancy-checkbox element-left">
										<input type="checkbox">
										<span>Remember me</span>
									</label> --}}
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block"><i
                                        class="fa fa-fw fa-sign-in mr-1"></i> Masuk</button>
                                <a href="https://trustmedis.com/demo/" target="_blank" class="btn  "><i
                                        class="fa fa-plus text-muted mr-1"></i> Belum punya akun</a>
                                {{-- <div class="bottom">
									<span class="helper-text"><i class="fa fa-lock"></i> <a href="#">Forgot password?</a></span>
								</div> --}}
                            </form>
                        </div>
                    </div>
                    <div class="right">
                        <div class="overlay"></div>
                        <div class="content text" style="text-align: center">
                            <img src="{{asset('logo-tm1-white.svg')}}" height="200" style="opacity: 0.6;">
                            {{-- <h1 class="heading">Free Bootstrap dashboard template</h1>
							<p>by The Develovers</p> --}}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END WRAPPER -->
</body>

</html>
