@foreach($lops as $lop)
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <span>Danh sách lớp</span> {{ $lop->ten_lop }}
                    <span class="badge bg-primary ms-2">
                        {{ $lop->total_students }} sinh viên
                    </span>
                    <div>
                        {{ $lop->ten_chuyennganh }} - {{ $lop->ten_khoa }}
                    </div>
                </h5>
            </div>
            <div class="card-body">
                @if($lop->sinhviens->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Năm vào học</th>
                                    <th style="width: 125px;">Thao tác</th>
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
                                            <a href="{{ route('qlnd.sinhvien.detail', $sv->id_sinhvien) }}" 
                                               class="btn btn-soft-primary btn-sm" 
                                               title="Xem chi tiết">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="{{ route('sinhvien.edit', $sv->id_sinhvien) }}" 
                                               class="btn btn-soft-info btn-sm" 
                                               title="Chỉnh sửa">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $lop->sinhviens->links('vendor.pagination.bootstrap-5') }}
                        </div>
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