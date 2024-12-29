@extends('layouts.vertical', ['title' => 'Chi tiết học phí'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Thông tin sinh viên</h4>

                        <div class="text-start">
                            <p class="text-muted mb-2 font-13">
                                <strong>Mã sinh viên:</strong>
                                <span class="ms-2">{{ $hocphi['sinh_vien']['id'] }}</span>
                            </p>

                            <p class="text-muted mb-2 font-13">
                                <strong>Họ và tên:</strong>
                                <span class="ms-2">{{ $hocphi['sinh_vien']['ten'] }}</span>
                            </p>

                            <p class="text-muted mb-2 font-13">
                                <strong>Lớp:</strong>
                                <span class="ms-2">{{ $hocphi['sinh_vien']['lop'] }}</span>
                            </p>

                            <p class="text-muted mb-2 font-13">
                                <strong>Email:</strong>
                                <span class="ms-2">{{ $hocphi['sinh_vien']['email'] }}</span>
                            </p>

                            <p class="text-muted mb-2 font-13">
                                <strong>Số điện thoại:</strong>
                                <span class="ms-2">{{ $hocphi['sinh_vien']['so_dien_thoai'] }}</span>
                            </p>

                            <p class="text-muted mb-2 font-13">
                                <strong>Trạng thái:</strong>
                                <span class="ms-2">
                                @php
                                    $badgeClass = match($hocphi['trang_thai'] ?? '') {
                                        'Đã thanh toán' => 'bg-success',
                                        'Đang xử lý' => 'bg-warning',
                                        default => 'bg-danger'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $hocphi['trang_thai'] ?? 'Chưa xác định' }}</span>
                            </span>
                            </p>
                        </div>

                        <hr>

                        <h4 class="header-title mb-3">Tổng quan học phí</h4>
                        <div class="table-responsive">
                            <table class="table table-sm table-centered mb-0">
                                <tbody>
                                <tr>
                                    <td><strong>Tổng học phí</strong></td>
                                    <td class="text-end">{{ number_format($hocphi['tong_tien'], 0, ',', '.') }} đ</td>
                                </tr>
                                <tr>
                                    <td><strong>Tổng miễn giảm</strong></td>
                                    <td class="text-end text-success">
                                        -{{ number_format($hocphi['tong_mien_giam'], 0, ',', '.') }} đ
                                    </td>
                                </tr>
                                <tr>
                                    <td><h4>Còn lại</h4></td>
                                    <td class="text-end">
                                        <h4>{{ number_format($hocphi['tong_phai_dong'], 0, ',', '.') }} đ</h4>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Chi tiết các khoản phí</h4>

                        <div class="table-responsive">
                            <table class="table table-centered table-hover mb-0">
                                <thead>
                                <tr>
                                    <th>Môn học</th>
                                    <th>Số tín chỉ</th>
                                    <th>Tên khoản phí</th>
                                    <th class="text-end">Số tiền</th>
                                    <th class="text-end">Miễn giảm</th>
                                    <th>Lý do miễn giảm</th>
                                    <th class="text-end">Thành tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($hocphi['chi_tiet'] as $ct)
                                    <tr>
                                        <td>{{ $ct['mon_hoc']['ten'] ?? 'N/A' }}</td>
                                        <td>{{ $ct['mon_hoc']['so_tin_chi'] ?? 'N/A' }}</td>
                                        <td>{{ $ct['ten_khoan_phi'] }}</td>
                                        <td class="text-end">{{ number_format($ct['so_tien'], 0, ',', '.') }} đ</td>
                                        <td class="text-end text-success">
                                            @if($ct['mien_giam']['tong_mien_giam'] > 0)
                                                -{{ number_format($ct['mien_giam']['tong_mien_giam'], 0, ',', '.') }} đ
                                                @if($ct['mien_giam']['ty_le'])
                                                    ({{ $ct['mien_giam']['ty_le'] }}%)
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $ct['mien_giam']['mo_ta'] ?? 'N/A' }}</td>
                                        <td class="text-end">
                                            {{ number_format($ct['thanh_tien'], 0, ',', '.') }} đ
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="text-end mt-3">
                            <a href="{{ route('hocphi.index') }}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left"></i> Quay lại
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
