@extends('layouts.vertical', ['title' => 'Danh sách học phí'])

@section('css')
    <!-- DataTables css -->
    <link href="/assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet"
          type="text/css"/>
@endsection

@section('content')
    @include('layouts.shared.page-title', ['page_title' => 'Danh sách học phí', 'sub_title' => 'Quản lý học phí'])

    <div class="container-fluid">
        @foreach($hocPhiList->groupBy('trang_thai') as $trangThai => $hocPhis)
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                Học phí {{ $trangThai }}
                                <span class="badge bg-primary ms-2">
                            {{ $hocPhis->count() }} khoản phí
                        </span>
                            </h5>
                        </div>
                        <div class="card-body">
                            @if($hocPhis->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Sinh viên</th>
                                            <th>Tổng tiền</th>
                                            <th>Miễn giảm</th>
                                            <th>Còn lại</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($hocPhis as $hp)
                                            <tr>
                                                <td>{{ $hp['id_hocphi'] }}</td>
                                                <td>{{ $hp['ten_sinhvien'] }}</td>
                                                <td>{{ number_format($hp['tong_tien'], 0, ',', '.') }} đ</td>
                                                <td>{{ number_format($hp['tong_mien_giam'], 0, ',', '.') }} đ</td>
                                                <td>{{ number_format($hp['tong_tien'] - $hp['tong_mien_giam'], 0, ',', '.') }}
                                                    đ
                                                </td>
                                                <td>
                                                    @php
                                                        $badgeClass = match($hp['trang_thai']) {
                                                            'Đã thanh toán' => 'bg-success',
                                                            'Đang xử lý' => 'bg-warning',
                                                            default => 'bg-danger'
                                                        };
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }}">{{ $hp['trang_thai'] }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('hocphi.detail', $hp['id_hocphi']) }}"
                                                       class="btn btn-sm btn-primary"
                                                       title="Xem chi tiết">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('hocphi.edit', $hp['id_hocphi']) }}"
                                                       class="btn btn-sm btn-info"
                                                       title="Sửa học phí">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center p-4">
                                    <p class="text-muted">Không có khoản học phí nào</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('script')
    <!-- Datatables js -->
    <script src="/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="/assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                pageLength: 5,
                ordering: true,
                info: false,
                lengthChange: false,
                language: {
                    search: "Tìm kiếm:",
                    paginate: {
                        first: "Đầu",
                        last: "Cuối",
                        next: "Sau",
                        previous: "Trước"
                    },
                    emptyTable: "Không có dữ liệu",
                    zeroRecords: "Không tìm thấy kết quả phù hợp"
                }
            });
        });
    </script>
@endsection
