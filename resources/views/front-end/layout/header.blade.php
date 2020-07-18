<!-- header-start -->
<header>
    <div class="header-area slider_bg_1">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid p-0">
                <div class="row align-items-center no-gutters">
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo-img">
                            <a href="{{route('home')}}">
                                <img src="img/newlogo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7">
                        <div class="main-menu  d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <li><a class="active" href="{{route('home')}}">Trang chủ</a></li>
                                    <li><a href="#">Danh mục <i class="ti-angle-down"></i></a>
                                        <ul class="submenu">
                                            @foreach($quizzes as $quiz)
                                            <li><a href="#">{{$quiz->title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                        <div class="log_chat_area d-flex align-items-center">
                            @if(Auth::check())
                            <ul class="nav page-navigation">
                                <li class="nav-item dropdown">
                                    <a class="nav-link text-white" data-toggle="dropdown" id="navbarDropdown" href="#">
                                        <img class="rounded-circle" src="{{Auth::user()->avatar_url ?? 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRW6X2lldt_gy2tcbXCKBbKWNVBpH-f1Mcjsw&usqp=CAU'}}" width="50" height="50px">
                                        {{Auth::user()->name}}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{route('user.profile')}}">
                                            Hồ sơ
                                        </a>
                                        <a class="dropdown-item" href="{{route('user.history')}}">
                                            Lịch sử bài thi
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            Đăng xuất
                                        </a>
                                    </div>
                                </li>
                            </ul>
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