@extends('front-end.layout.layout')
@section('styles')
<link rel="stylesheet" href="css/form-test.css">
@stop
@section('content')
<!-- popular_courses_start -->
<div class="popular_courses">
    <div class="all_courses">
        <div class="container">
            <div class="privew bg-light">
                <form action="{{ route('user.postResetPassword',$token) }}" method="post">
                    @csrf
                    <input type="password" name="password" placeholder="Nhap mat khau" required>
                    <input type="password" name="rePassword" placeholder="Nhap lai mat khau" required>
                    <input type="submit" value="Xac nhan">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- popular_courses_end-->


@stop
