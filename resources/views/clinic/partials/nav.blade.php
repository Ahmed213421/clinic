<!-- header top section start -->
      <div class="header_top_section">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <div class="header_top_main">
                     <div class="call_text"><a href="#"><span class="padding_right0"><i class="fa fa-phone" aria-hidden="true"></i></span>  Call : +01 1234567890</a></div>
                     <div class="call_text_2"><a href="#"><span class="padding_right0"><i class="fa fa-envelope" aria-hidden="true"></i></span> demo@gmail.com</a></div>
                     <div class="call_text_1"><a href="#"><span class="padding_right0"><i class="fa fa-map-marker" aria-hidden="true"></i></span> Location</a></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- header top section end -->
      <!-- header section start -->
      <div class="header_section">
         <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
               <a class="navbar-brand"href="index.html"><img src="images/logo.png"></a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">
                     <li class="nav-item active">
                        <a class="nav-link" href="index.html">Home</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="treatment.html">Treatment</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="doctors.html">Doctors</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="blog.html">Blog</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact Us</a>
                     </li>
                  </ul>
                  <form class="form-inline my-2 my-lg-0">
                  </form>
               </div>
            </nav>
            <div class="custom_bg">
               <div class="custom_menu">
                  <ul>
                     <li class="active"><a href="index.html">Home</a></li>
                     <li><a href="about.html">About</a></li>
                     <li><a href="treatment.html">Treatment</a></li>
                     <li><a href="doctors.html">Doctors</a></li>
                     <li><a href="blog.html">Blog</a></li>
                     <li><a href="contact.html">Contact Us</a></li>
                  </ul>
               </div>
               <form class="form-inline my-2 my-lg-0">
                  <div class="search_btn">

                      @guest
        <li>
            <a href="{{ route('login') }}">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span class="signup_text">Login</span>
            </a>
        </li>
        <li>
            <a href="{{ route('register') }}">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span class="signup_text">Sign Up</span>
            </a>
        </li>
    @else
        <li class="nav-item dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span class="signup_text">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ trans('general.logout') }}</a>

            </div>
        </li>
    @endguest


                     <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                  </div>
               </form>
            </div>
         </div>
         <!-- header section end -->
         @yield('we care')
         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                    @csrf
                </form>
      </div>
      <!-- header section end -->
