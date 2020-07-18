@extends('front-end.layout.layout')

@section('content')
@include('front-end.layout.slider')
<!-- popular_courses_start -->
<div class="popular_courses">
    <div class="all_courses">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title text-center mb-100">
                        <h3>Bài Thi Mới</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($exams as $exam)
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single_courses">
                        <div class="thumb">
                            <a href="#">
                                <img src="{{$exam->image_url}}" alt="" width="150px" height="200px">
                            </a>
                        </div>
                        <div class="courses_info">
                            <span>{{$exam->quiz['title']}}</span>
                            <h3> <a href="{{ route('exam.detail.get',$exam->id) }}" onclick="return confirm('Bạn có muốn bắt đầu bài thi')">{{$exam->title}}</a></h3>
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
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- popular_courses_end-->

@stop