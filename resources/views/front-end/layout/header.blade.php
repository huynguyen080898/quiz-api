<!-- header-start -->
<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid p-0">
                <div class="row align-items-center no-gutters">
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo-img">
                            <a href="index.html">
                                <img src="img/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7">
                        <div class="main-menu  d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <li><a class="active" href="index.html">Trang chủ</a></li>
                                    <li><a href="#">Danh mục <i class="ti-angle-down"></i></a>
                                        <ul class="submenu">
                                            @foreach($quizzes as $quiz)
                                            <li><a href="#">{{$quiz->title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li><a href="about.html">About</a></li>
                                    <li><a href="#">blog <i class="ti-angle-down"></i></a>
                                        <ul class="submenu">
                                            <li><a href="blog.html">blog</a></li>
                                            <li><a href="single-blog.html">single-blog</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                        <div class="log_chat_area d-flex align-items-center">
                            @if(Auth::check())
                            <span class="login popup-with-form mr-3"> {{Auth::user()->name}}</span>
                            <i class="flaticon-user"></i>
                            @else
                            <a href="#test-form" class="login popup-with-form">
                                <i class="flaticon-user"></i>
                                <span>Đăng nhập</span>
                            </a>
                            @endif
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</header>
<!-- header-end -->