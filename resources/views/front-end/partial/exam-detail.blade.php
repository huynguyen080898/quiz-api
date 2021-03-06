<form action="" method="post" id="formQuestion">
    @csrf
    @foreach($data as $value)
    <div class="questions slider_bg_1">
        {{$value->question['title']}}
        <input type="hidden" value="{{$value->question['id']}}" name="question_id" />
    </div>

    <ul class="answerList">
        @if($value->question['answer_type'] == 'single_select')
        @foreach($value->question['answers'] as $answer)
        <li>
            <label>
                <input type="radio" name="answer" value="{{$answer->id}}" onclick="radio();changeColor({{$data->currentPage()}});" {{in_array($answer->id, $user_answer) ? 'checked="checked"' : ''}} />
                {{$answer->title}}
            </label>
        </li>
        @endforeach
        @elseif($value->question['answer_type'] == 'multi_select')
        @foreach($value->question['answers'] as $answer)
        <li>
            <label>
                <input type="checkbox" name="answer[]" value="{{$answer->id}}" onclick="checkbox();changeColor({{$data->currentPage()}});" {{in_array($answer->id, $user_answer) ? 'checked="checked"' : ''}} />
                {{$answer->title}}
            </label>
        </li>
        @endforeach
        @else
        <input type="text" name="answer" class="form-control" onchange="filltext();changeColor({{$data->currentPage()}});" value={{!empty($user_answer) ? $user_answer[0] : '' }} />
        @endif
    </ul>
    @endforeach
</form>
<div class=" row mb-4 ml-4">
    <a href="{{$data->previousPageUrl()}}" class="ajax button btn-secondary rounded mr-2">Back</a>
    <a href="{{$data->nextPageUrl()}}" class="ajax button btn-primary rounded mr-2">Next</a>
    @if($data->currentPage() == $data->total())
    <a href="{{route('exam.result',$data[0]->exam['results'][0]->id)}}" class="button btn-primary rounded" id="btnResult" onclick="return confirm('Bạn có muốn nộp bài không ?')">Nộp Bài</a>
    @endif
</div>
<div>


    <span>{!!$data->currentPage()!!} of {!!$data->total()!!}</span>
</div>