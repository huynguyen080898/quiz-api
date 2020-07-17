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
                <div class="d-flex flex-row-reverse">
                    <div class="p-2 m-2 border border-primary rounded">Thời gian còn lại: <span class="text-danger mr-3" id="demo"></span></div>
                </div>

                <div id="ajax-container" class="questionsBox">
                    @include('front-end.partial.exam-detail')
                </div>


            </div>

            <div class="row mt-4">
                <div class="col-xl-12 d-flex justify-content-center">
                    @for($i = 1; $i <= $data->total(); $i++)
                        <a class="ajax btn btn-secondary my-2 mx-1" id="page{{$i}}" href="{{route('exam.detail.get',$data[0]->exam_id)}}?page={{$i}}">{{$i}}</a>
                        @endfor
                </div>

            </div>
        </div>
    </div>
</div>
<!-- popular_courses_end-->


@stop

@section('scripts')
<script type="text/javascript">
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getData(page);
            }
        }
    });

    $(document).ready(function() {

        $(document).on('click', '.ajax', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            getData(page);
        });

    });

    function getData(page) {
        $.ajax({
            url: '{{ route("exam.detail.get",$data[0]->exam_id) }}' + '?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data) {
            $("#ajax-container").empty().html(data);
        }).fail(function(jqXHR, ajaxOptions, thrownError) {
            alert(jqXHR + ajaxOptions + thrownError);
        });
    }
</script>
<script type="text/javascript">
    var result_id = "{{$data[0]->exam['results'][0]->id}}";

    function radio() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: '{{route("user.answer")}}',
            type: "PUT",
            data: {
                user_answer: $("input[name=answer]:checked", "#formQuestion").val(),
                question_id: $("input[name=question_id]").val(),
                result_id: result_id,
                type: "radio"
            },

            success: function(data) {
                if (data.errors) {
                    alert(data.errors);
                }
            },
        });
    }

    function checkbox() {
        var answers = [];

        $("input[type='checkbox']").each(function() {
            answers.push({
                id: parseInt(this.value),
                checked: this.checked
            })
        });
        console.log(answers);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{route("user.answer")}}',
            type: 'PUT',
            data: {
                user_answer: answers,
                question_id: $('input[name=question_id]').val(),
                result_id: result_id,
                type: 'checkbox'
            },

            success: function(data) {
                if ((data.errors)) {
                    alert(data.errors);
                }

            }
        });
    }

    function filltext() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{route("user.answer")}}',
            type: 'PUT',
            data: {
                user_answer: $('input[name=answer]').val(),
                question_id: $('input[name=question_id]').val(),
                result_id: result_id,
                type: 'fill_text'
            },

            success: function(data) {
                if ((data.errors)) {
                    alert(data.errors);
                }
            }
        });
    }
</script>
@stop