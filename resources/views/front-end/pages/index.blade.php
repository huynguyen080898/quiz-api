@extends('front-end.layout.layout')

@section('content')
@include('front-end.layout.slider')
<!-- popular_courses_start -->
<div class="popular_courses">
    <div class="all_courses">
        <div class="container">
            <div class="row">

                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single_courses">
                        <div class="thumb">
                            <a href="#">
                                <img src="img/courses/1.png" alt="">
                            </a>
                        </div>
                        <div class="courses_info">
                            <span>Photoshop</span>
                            <h3><a href="#">ádadasd</a></h3>
                            <div class="star_prise d-flex justify-content-between">
                                <span class="text-muted">
                                    Ngày mở
                                </span>
                                <span class="text-muted">
                                    Ngày đóng
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- popular_courses_end-->
@stop