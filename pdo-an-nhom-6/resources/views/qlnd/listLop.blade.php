@extends('layouts.vertical', ['title' => 'Danh sách lớp'])

@section('content')
<div class="container-fluid">
    @foreach($lops as $lop)
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        Lớp {{ $lop->ten_lop }}
                        @if($lop->ma_phong_hoc)
                            - Phòng {{ $lop->ma_phong_hoc }}
                        @endif
                        <span class="badge bg-primary ms-2">
                            {{ $lop->sinhviens->count() }} sinh viên
                        </span>
                    </h5>
                </div>
                <div class="card-body">
                    @if($lop->sinhviens->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Họ và tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Năm vào học</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lop->sinhviens as $sv)
                                    <tr>
                                        <td>{{ $sv->id_sinhvien }}</td>
                                        <td>{{ $sv->ten_sinhvien }}</td>
                                        <td>{{ $sv->email }}</td>
                                        <td>{{ $sv->so_dien_thoai }}</td>
                                        <td>{{ $sv->nam_vao_hoc }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('sinhvien.show', $sv->id_sinhvien) }}" 
                                                   class="btn btn-sm btn-primary" 
                                                   title="Xem chi tiết">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>
                                                <a href="{{ route('sinhvien.edit', $sv->id_sinhvien) }}" 
                                                   class="btn btn-sm btn-info" 
                                                   title="Chỉnh sửa">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center p-4">
                            <p class="text-muted">Không có sinh viên nào trong lớp này</p>
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
$(document).ready(function() {
    $('.table').DataTable({
        pageLength: 5,
        ordering: true,
        info: false,
        lengthChange: false
    });
});
</script>
@endsection 