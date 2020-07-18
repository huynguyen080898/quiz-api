@extends('back-end.layout')
<!-- @section('title', 'Quiz') -->
@section('styles')
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@stop

@section('content')

<h3 style="text-align: center">Danh Sách Đề Thi</h3>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('exam.create') }}" class="btn btn-success float-right">Tạo Đề Thi</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Danh mục</th>
                        <th>Tên đề thi</th>
                        <th>Thời gian thi (phút)</th>
                        <th>Ngày mở</th>
                        <th>Ngày đóng</th>
                        <th>Trạng thái</th>
                        <th>Xem chi tiết</th>
                        <th>Xem thống kê</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach ($exams as $exam)
                    <tr>
                        <th> {{ $i++ }} </th>
                        <td> {{ $exam->quiz['title'] }} </td>
                        <td> {{ $exam->title }} </td>
                        <td> {{ $exam->time }} (phut)</td>
                        <td> {{ $exam->start_date}}</td>
                        <td> {{ $exam->end_date}}</td>
                        <td> {{ $exam->status }}</td>
                        <td><a href="{{route('exam.detail', $exam->id)}}">Xem chi tiết</a></td>
                        <td><a href="{{route('exam.statistical',$exam->id)}}">Xem thống kê</a></td>
                        <td><a href="{{route('exam.edit',$exam->id)}}" class="btn btn-info btn-circle"><i class="fa fas fa-edit"></i></a>
                            <a href="#" onclick="return confirm('Bạn có thật sự muốn xóa?')" class="btn btn-danger btn-circle"><i class="fa fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@stop
@section('scripts')
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
@stop