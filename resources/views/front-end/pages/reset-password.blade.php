@extends('front-end.layout.layout')
@section('content')
<!-- popular_courses_start -->
<div class="popular_courses">
    <div class="all_courses">
        <div class="container">
            <div class="privew bg-light">
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

            </div>
        </div>
    </div>
</div>
<!-- popular_courses_end-->
@stop