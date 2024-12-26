@extends('layouts.vertical', ['title' => "Chi tiết học phí lớp $lop"])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('hocphi.sales') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Quay lại
                        </a>
                    </div>
                    <h4 class="page-title">Chi tiết học phí lớp {{ $lop }}</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>Mã SV</th>
                                    <th>Họ tên</th>
                                    <th>Học phí đã nộp</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{ $student->id_sinhvien }}</td>
                                        <td>{{ $student->ten_sinhvien }}</td>
                                        <td>{{ number_format($student->so_tien, 0, ',', '.') }}đ</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
