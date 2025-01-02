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
                                    <th>Tên sinh viên</th>
                                    <th>Tổng học phí</th>
                                    <th>Đã thu</th>
                                    <th>Chưa thu</th>
                                    <th>Đang xử lý</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày thanh toán</th>
                                    <th>Phương thức</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{ $student->id_sinhvien }}</td>
                                        <td>{{ $student->ten_sinhvien }}</td>
                                        <td>{{ number_format($student->so_tien, 0, ',', '.') }}đ</td>
                                        <td>{{ number_format($student->da_thu, 0, ',', '.') }}đ</td>
                                        <td>{{ number_format($student->chua_thu, 0, ',', '.') }}đ</td>
                                        <td>{{ number_format($student->dang_xu_ly, 0, ',', '.') }}đ</td>
                                        <td>
                <span class="badge bg-{{ $student->trang_thai_hocphi === 'Đã thanh toán' ? 'success' :
                    ($student->trang_thai_hocphi === 'Đang xử lý' ? 'warning' : 'danger') }}">
                    {{ $student->trang_thai_hocphi }}
                </span>
                                        </td>
                                        <td>{{ $student->ngay_thanhtoan ? date('d/m/Y H:i', strtotime($student->ngay_thanhtoan)) : 'Chưa thanh toán' }}</td>
                                        <td>{{ $student->phuong_thuc ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr class="table-info">
                                    <th colspan="2">Tổng cộng</th>
                                    <th>{{ number_format($students->sum('so_tien'), 0, ',', '.') }}đ</th>
                                    <th>{{ number_format($students->sum('da_thu'), 0, ',', '.') }}đ</th>
                                    <th>{{ number_format($students->sum('chua_thu'), 0, ',', '.') }}đ</th>
                                    <th>{{ number_format($students->sum('dang_xu_ly'), 0, ',', '.') }}đ</th>
                                    <th colspan="3"></th>
                                </tr>
                                </tfoot>
                            </table>

                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card bg-success text-white">
                                            <div class="card-body">
                                                <h5 class="card-title">Tổng đã thu</h5>
                                                <p class="card-text">{{ number_format($students->sum('da_thu'), 0, ',', '.') }}đ</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-danger text-white">
                                            <div class="card-body">
                                                <h5 class="card-title">Tổng chưa thu</h5>
                                                <p class="card-text">{{ number_format($students->sum('chua_thu'), 0, ',', '.') }}đ</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-warning text-white">
                                            <div class="card-body">
                                                <h5 class="card-title">Tổng đang xử lý</h5>
                                                <p class="card-text">{{ number_format($students->sum('dang_xu_ly'), 0, ',', '.') }}đ</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
