<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>@yield('title')</title>


    @if(App::getLocale() =='ar')
    <link rel="stylesheet" href="{{asset('admin/rtl/css/simplebar.css')}}">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{asset('admin/rtl/css/feather.css')}}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{asset('admin/rtl/css/daterangepicker.css')}}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{asset('admin/rtl/css/app-light.css')}}" id="lightTheme">
    {{-- <link rel="stylesheet" href="{{asset('admin/rtl/css/app-dark.css')}}" id="darkTheme" disabled> --}}

    @else

    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{asset('admin/css/simplebar.css')}}">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{asset('admin/css/feather.css')}}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{asset('admin/css/daterangepicker.css')}}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{asset('admin/css/app-light.css')}}" id="lightTheme">
    <link rel="stylesheet" href="{{asset('admin/css/app-dark.css')}}" id="darkTheme" disabled>
    @endif

    @yield('css')
  </head>
<body class="light ">
    <div class="wrapper vh-100">
        <form class="col-lg-3 col-md-4 col-10 mx-auto text-center" method="POST" action="{{ route('register') }}">
    @csrf

    <div class="row align-items-center h-100">
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ url('/') }}">
            <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 120 120" xml:space="preserve">
                <g>
                    <polygon class="st0" points="78,105 15,105 24,87 87,87" />
                    <polygon class="st0" points="96,69 33,69 42,51 105,51" />
                    <polygon class="st0" points="78,33 15,33 24,15 87,15" />
                </g>
            </svg>
        </a>
        <h2 class="my-3">Register</h2>
    </div>

    <div class="form-group">
        <label for="name">Full Name</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
               name="name" value="{{ old('name') }}" required autofocus>
        @error('name')
        <div class="invalid-feedback text-left">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
               name="email" value="{{ old('email') }}" required>
        @error('email')
        <div class="invalid-feedback text-left">{{ $message }}</div>
        @enderror
    </div>

    <hr class="my-4">

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="form-group">
                <label for="password">New Password</label>
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required>
                @error('password')
                <div class="invalid-feedback text-left">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" class="form-control"
                       name="password_confirmation" required>
            </div>
        </div>

        <div class="col-md-6">
            <p class="mb-2">Password requirements</p>
            <p class="small text-muted mb-2">To create a new password, you have to meet all of the following requirements:</p>
            <ul class="small text-muted pl-4 mb-0 text-left">
                <li>Minimum 8 characters</li>
                <li>At least one special character</li>
                <li>At least one number</li>
                <li>Cannot be the same as a previous password</li>
            </ul>
        </div>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
    <p class="mt-5 mb-3 text-muted text-center">© 2025</p>
        </form>

      </div>
    </div>

    <script src="{{asset('admin/js/jquery.min.js')}}"></script>
<script src="{{asset('admin/js/popper.min.js')}}"></script>
<script src="{{asset('admin/js/moment.min.js')}}"></script>
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/js/simplebar.min.js')}}"></script>
<script src='{{asset('admin/js/daterangepicker.js')}}'></script>
<script src='{{asset('admin/js/jquery.stickOnScroll.js')}}'></script>
<script src="{{asset('admin/js/tinycolor-min.js')}}"></script>
<script src="{{asset('admin/js/config.js')}}"></script>
<script src="{{asset('admin/js/apps.js')}}"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-56159088-1');
</script>

@yield('js')
</body>

</html>
