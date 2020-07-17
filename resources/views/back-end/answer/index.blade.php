@extends('back-end.layout')
<!-- @section('title', 'Quiz') -->
@section('styles')
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@stop

@section('content')

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Câu trả lời</th>
                        <th>Correct</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach ($answers as $answer)
                    <tr>
                        <th> {{ $i++ }} </th>
                        <td> {{ $answer->title }} </td>
                        <td> {{ ($answer->correct) ? 'Đúng' : 'Sai' }} </td>
                        <td><a href="#" class="btn btn-info btn-circle"><i class="fa fas fa-edit"></i></a>
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