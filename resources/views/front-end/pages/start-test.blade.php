@extends('front-end.layout.layout')

@section('content')

<div class="privew bg-light">
    <div class="d-flex flex-row-reverse">
        <div class="p-2 m-2 border border-primary rounded">Thời gian còn lại: <span class="text-danger mr-3" id="demo"></span></div>
    </div>

    <div id="ajax-container" class="questionsBox">
        @include('home.partial.quiz-detail')
    </div>

    <div class="text-center mt-3">
        @for($i = 1; $i <= $exam_detail->total(); $i++)
            <a class="ajax btn btn-secondary my-2 mx-1" id="page{{$i}}" href="{{route('quiz.start',$exam->id)}}?page={{$i}}">{{$i}}</a>
            @endfor
    </div>
</div>

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

    function changeColor(page_current) {
        document.getElementById('page' + page_current).style.backgroundColor = "blue";
    }

    function getData(page) {
        $.ajax({
            url: '{{ route("quiz.start",$exam->id) }}' + '?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data) {
            $("#ajax-container").empty().html(data);

            var totalPages = "{{$exam_detail -> total()}}";
            if (page == totalPages) {
                document.getElementById("btnResult").href = "{{route('result',$result->id)}}";
            }

        }).fail(function(jqXHR, ajaxOptions, thrownError) {
            alert(jqXHR + ajaxOptions + thrownError);
        });
    }
</script>

<script type="text/javascript">
    // Set the date we're counting down to
    var countDownDate = new Date("{!!$exam_time!!}").getTime();
    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = minutes + ":" + seconds + " giây ";

        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "Het Gio";
            window.location.assign("{{route('result',$result->id)}}");
            return false;
        }
    }, 1000);
</script>

<script type="text/javascript">
    function radio() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{route("user.answer.radio")}}',
            type: 'PUT',
            data: {
                'user_answer': $('input[name=answer]:checked', '#formQuestion').val(),
                'question_id': $('input[name=question_id]').val(),
                'result_id': '{{$result->id}}'
            },

            success: function(data) {
                if ((data.errors)) {
                    alert(data.errors);
                }

            }
        });
    }

    function checkbox() {
        var answers = [];

        $("input[type='checkbox']").each(function() {
            answers[this.value] = this.checked
        });

        console.log(answers);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{route("user.answer.checkbox")}}',
            type: 'PUT',
            data: {
                'user_answers': answers,
                'question_id': $('input[name=question_id]').val(),
                'result_id': '{{$result->id}}'
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
            url: '{{route("user.answer.filltext")}}',
            type: 'PUT',
            data: {
                'user_answer': $('input[name=answer]').val(),
                'question_id': $('input[name=question_id]').val(),
                'result_id': '{{$result->id}}'
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