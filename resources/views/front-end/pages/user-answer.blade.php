@extends('front-end.layout.layout')

@section('content')
<div class="text-center" style="margin-top:120px">
    <h3>Chi Tiết Bài Thi</h3>
</div>
<div class="popular_courses">
    <div class="all_courses">
        <div class="container">
            <div class="pl-5" style="font-size:18px">
                @foreach($data as $value)
                <div class="row my-1">
                    @if($value['question_type'] == 'image')
                    <img class="card-img-top p-2" src="{{ $value['question_title']}}" width="600px" height="250px">
                    @else
                    <span class="font-weight-bold">{!! $value['question_title'] !!}</span>
                    @endif
                </div>
                <div style="font-size:18px;color:black">
                    @if($value['answer_type'] == 'single_select')
                    @foreach($value['answers'] as $answer)

                    <div class="form-check disabled">
                        <input class="form-check-input" type="radio" disabled @if(in_array($answer['id'], $value['user_answers'])) checked @endif>
                        <label class="form-check-label @if((in_array($answer['id'], $value['user_answers']) && $answer['correct'])) text-success @elseif((in_array($answer['id'], $value['user_answers']) && !$answer['correct'])) text-danger @endif">
                            {{$answer['title']}}
                        </label>
                    </div>
                    @endforeach
                    @elseif($value['answer_type'] == 'multi_select')
                    @foreach($value['answers'] as $answer)
                    <div class="form-check disabled">
                        <input class="form-check-input" type="checkbox" disabled @if(in_array($answer['id'], $value['user_answers'])) checked @endif>
                        <label class="form-check-label @if((in_array($answer['id'], $value['user_answers']) && $answer['correct'])) text-success @elseif((in_array($answer['id'], $value['user_answers']) && !$answer['correct'])) text-danger @endif">
                            {{$answer['title']}}
                        </label>
                    </div>
                    @endforeach
                    @else
                    <label class="form-check-label @if(in_array($value['user_answers'][0], $value['answers'])) text-success @else text-danger @endif">
                        @if($value['user_answers'][0]) {{$value['user_answers'][0]}} @endif
                    </label>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@stop