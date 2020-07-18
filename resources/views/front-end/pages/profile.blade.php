@extends('front-end.layout.layout')

@section('content')
<!-- popular_courses_start -->
<div class="text-center" style="margin-top:120px">
    <h3>Thông Tin Tài Khoản</h3>
</div>
<div class="popular_courses">
    <div class="all_courses">
        <div class="container">
            <div class="privew">
                <form action="{{route('user.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('notifications.messages')
                    @include('notifications.errors')
                    <div class="row">
                        <div class="col-lg-4 col-xl-4 col-md-6 px-5 border-right">
                            <div class="form-group d-flex justify-content-center">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRW6X2lldt_gy2tcbXCKBbKWNVBpH-f1Mcjsw&usqp=CAU" class="rounded-circle" width="200px" height="200px" alt="avatar">
                            </div>
                            <div class="form-group d-flex justify-content-center">
                                <input type="file" class="text-center" name="avatar">
                            </div>

                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-6 px-5">

                            <div class="form-group">
                                <label>Họ và tên</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên ..." value="{{$user->name}}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Nhập email ..." value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                                <label>Mã số sinh viên</label>
                                <input type="text" name="student_code" class="form-control" placeholder="Nhập mã số sinh viên ..." value="{{$user->student_code}}">
                            </div>
                        </div>

                    </div>
                    <div class="row d-flex justify-content-end px-5">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- popular_courses_end-->


@stop