@extends('layouts.vertical', ['title' => 'Danh sách miễn giảm học phí'])

@section('css')
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('miengiam.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i> Thêm miễn giảm
                        </a>
                    </div>
                    <h4 class="page-title">Danh sách miễn giảm học phí</h4>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table id="mien-giam-table" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>Môn học</th>
                                <th>Tỷ lệ giảm (%)</th>
                                <th>Số tiền giảm</th>
                                <th>Thời gian áp dụng</th>
                                <th>Mô tả</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mienGiamList as $mg)
                                <tr>
                                    <td>{{ $mg->ten_monhoc }}</td>
                                    <td>{{ number_format($mg->ty_le_mien_giam, 2) }}%</td>
                                    <td>{{ $mg->so_tien_mien_giam ? number_format($mg->so_tien_mien_giam, 0, ',', '.') . ' đ' : 'N/A' }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($mg->ngay_bat_dau)->format('d/m/Y') }}
                                        @if($mg->ngay_ket_thuc)
                                            - {{ \Carbon\Carbon::parse($mg->ngay_ket_thuc)->format('d/m/Y') }}
                                        @else
                                            - Không giới hạn
                                        @endif
                                    </td>
                                    <td>{{ $mg->mo_ta }}</td>
                                    <td>
                                    <span class="badge bg-{{ $mg->trang_thai == 'active' ? 'success' : 'danger' }}">
                                        {{ $mg->trang_thai == 'active' ? 'Đang áp dụng' : 'Ngừng áp dụng' }}
                                    </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('miengiam.edit', $mg->id_mien_giam) }}"
                                           class="btn btn-sm btn-info me-2">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-sm btn-danger delete-mien-giam"
                                                data-id="{{ $mg->id_mien_giam }}"
                                                data-monhoc="{{ $mg->ten_monhoc }}">
                                            <i class="mdi mdi-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- jQuery (if not already included) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function () {
            // Delete functionality
            $('.delete-mien-giam').click(function () {
                var button = $(this);
                var id = button.data('id');
                var monhoc = button.data('monhoc');

                Swal.fire({
                    title: 'Xác nhận xóa?',
                    html: `Bạn có chắc chắn muốn xóa miễn giảm cho môn <strong>${monhoc}</strong>?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/thuan/miengiam/${id}`,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Thành công!',
                                        text: response.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Không thể xóa!',
                                        text: response.message || 'Miễn giảm này đang được sử dụng trong học phí',
                                        confirmButtonText: 'Đóng'
                                    });
                                }
                            },
                            error: function (xhr) {
                                let message = 'Có lỗi xảy ra khi xóa miễn giảm';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    message = xhr.responseJSON.message;
                                }
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi!',
                                    text: message,
                                    confirmButtonText: 'Đóng'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>

@endpush
