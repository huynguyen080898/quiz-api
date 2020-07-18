@extends('front-end.layout.layout')

@section('content')
<!-- popular_courses_start -->
<div class="text-center" style="margin-top:120px">
    <h3>Kết Quả Thi</h3>
</div>
<div class="popular_courses">
    <div class="all_courses">
        <div class="container">
            <div class="row h-100">
                <div class="col-6 mx-auto">
                    <div class="border border-primary rounded p-3 bg-light text-center">
                        <h2 class="text-center text-danger">Congratulations!</h2>
                        <div class="align-items-center">
                            <p><b>Số câu đúng: {{ $result->total_true_answer }}/{{ $result->total_question}} câu</b></p>
                            <p><b>Điểm: {{ $result->score }} điểm</b></p>
                        </div>
                        <a class="btn btn-primary" href="{{ route('home') }}">Ok</a>
                        <a class="btn btn-info" href="#">Xem lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- popular_courses_end-->


@stop