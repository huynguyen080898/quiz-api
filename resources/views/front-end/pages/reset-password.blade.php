@extends('front-end.layout.layout')
<<<<<<< HEAD

=======
@section('styles')
<link rel="stylesheet" href="css/form-test.css">
@stop
>>>>>>> 312342a01d678b565250d9485aa4c0d3f20d1c91
@section('content')
<!-- popular_courses_start -->
<div class="popular_courses">
    <div class="all_courses">
        <div class="container">
            <div class="privew bg-light">
<<<<<<< HEAD
                <div class="px-5 mt-5 text-center pb-4">
                    <form action="{{ route('user.postResetPassword',$token) }}" method="post">
                        @csrf
                        <h3 class="my-4"> Thay đổi mật khẩu</h3>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Mật khẩu</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Xác nhận mật khẩu</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="" placeholder="Xác nhận mật khẩu">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Xác nhận</button>
                    </form>
                </div>

=======
                <form action="{{ route('user.postResetPassword',$token) }}" method="post">
                    @csrf
                    <input type="password" name="password" placeholder="Nhap mat khau" required>
                    <input type="password" name="rePassword" placeholder="Nhap lai mat khau" required>
                    <input type="submit" value="Xac nhan">
                </form>
>>>>>>> 312342a01d678b565250d9485aa4c0d3f20d1c91
            </div>
        </div>
    </div>
</div>
<!-- popular_courses_end-->


<<<<<<< HEAD
@stop
=======
@stop
>>>>>>> 312342a01d678b565250d9485aa4c0d3f20d1c91
