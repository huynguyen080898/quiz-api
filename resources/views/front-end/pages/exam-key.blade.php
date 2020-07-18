@extends('front-end.layout.layout')

@section('content')
<div class="row d-flex justify-content-center" style="margin-top:120px">
    <form method="post" action=" {{ route('result.key',$result_id)}} ">
        @csrf
        <div class="form-group">
            <label>Khóa bài thi</label>
            <input class="form-control" name="exam_key" type="text">
        </div>
        <button type="submit" class="btn btn-block btn-success">Vào Thi</button>

    </form>
</div>

@stop