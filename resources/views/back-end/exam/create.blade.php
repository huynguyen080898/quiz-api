@extends('back-end.layout')

<!-- @section('title', 'Add Exam')     -->
@section('styles')
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="container">
    <h3 style="text-align: center; color: red; font-weight: bold">Tạo Đề Thi</h3>

    <form method="post" action=" {{ route('exam.store')}} " enctype="multipart/form-data">
        @include('back-end.notifications.messages')
        @include('back-end.notifications.errors')
        @csrf
        <div class="form-group">
            <div class="input-group mb-3 form-group">
                <div class="input-group-prepend">
                    <label class="input-group-text">Quiz</label>
                </div>
                <select class="custom-select" name="quiz_id" id="quiz_id">
                    <option value="0">--- Chọn danh mục ---</option>
                    @foreach ($quizzes as $quiz)
                    <option value="{{$quiz->id}} "> {{ $quiz->title }} </option>
                    <input type="hidden" name="image_url" value="{{$quiz->image_url}}" />
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Tên</label>
            <input type="text" name="title" class="form-control" placeholder="Nhập tên đề thi...">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Ngày mở</label>
                <input class="date form-control datepicker" id="start_date" type="text" name="start_date">
            </div>
            <div class="form-group col-md-6">
                <label>Ngày đóng</label>
                <input class="date form-control datepicker" id="end_date" type="text" name="end_date">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Giờ bắt đầu thi</label>
                <input type="time" class="form-control" name="start_time">
                <!-- <input class="form-control" type="text" name="start_time"> -->
            </div>
            <div class="form-group col-md-6">
                <label>Thời gian thi (phút)</label>
                <input type="number" name="time" class="form-control" placeholder="Nhập thời gian thi (phút)...">
            </div>
        </div>
        <div class="form-group">
            <label>Khóa bài thi</label>
            <input class="form-control" name="key" type="text">
        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <input class="form-control" name="description" type="text" multiple>
        </div>

        <div class="form-group">
            @include('back-end.tab.import')
        </div>

        <button type="submit" class="btn btn-block btn-success">Thêm</button>
    </form>

</div>

@stop

@section('scripts')
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $('#start_date').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd/mm/yyyy',
    });

    $('#end_date').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd/mm/yyyy',
    });
</script>

<script type="text/javascript">
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

<script type="text/javascript">
    function enableFileTab() {
        $("#importByFile :input").attr("disabled", false);
        $("#importByTable :input").attr("disabled", true);
    }

    function enableTableTab() {
        $("#importByFile :input").attr("disabled", true);
        $("#importByTable :input").attr("disabled", false);
    }
</script>

<script type="text/javascript">
    $('#quiz_id').change(function() {
        var id = $(this).val();
        var url = "/quiz/" + id + "/count/question";
        console.log(url);
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(data) {
                if (data) {
                    $("#importByTable").empty();
                    $.each(data, function(key, value) {
                        $("#importByTable").append('<div class="form-group">' +
                            '<label> Loại câu hỏi: ' + value['type'] + ' (Số câu hỏi có trong ngân hàng câu hỏi: ' + value['total_question'] + ') </label>' +
                            '<input type="number" name="' + value['key'] + '" class="form-control" max="' + value['total_question'] + '"> </div>');
                    });
                }
            }
        });
    });
</script>
@stop