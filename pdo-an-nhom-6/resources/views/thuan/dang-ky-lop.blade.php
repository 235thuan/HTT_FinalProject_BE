@extends('layouts.vertical', ['title' => 'Đăng ký lớp'])


@section('content')
    <style>
        .student-table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .student-table th {
            background-color: #f8f9fa;
            padding: 1rem;
            font-weight: 600;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
        }

        .student-table td {
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }

        .status-badge {
            padding: 0.35em 0.65em;
            border-radius: 0.25rem;
            font-size: 0.875em;
            font-weight: 500;
        }

        .status-active {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .status-inactive {
            background-color: #f8d7da;
            color: #842029;
        }

        .assign-btn {
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .assign-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .assigned {
            background-color: #e2e3e5;
            color: #41464b;
        }

        .unassigned {
            background-color: #fff3cd;
            color: #664d03;
        }
    </style>
    <style>
        .student-table {
            width: 100%;
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .student-table th {
            background-color: #f8f9fa;
            padding: 12px;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
        }

        .student-table td {
            padding: 12px;
            vertical-align: middle;
            border-bottom: 1px solid #dee2e6;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        .section-title {
            color: #2c3e50;
            font-size: 1.2rem;
            margin: 0;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.875rem;
        }

        .btn-assign {
            padding: 6px 12px;
            border-radius: 4px;
            transition: all 0.3s;
        }

        .btn-assign:hover {
            transform: translateY(-1px);
        }

        .table-responsive {
            margin: 15px 0;
        }
    </style>


    <div class="container-fluid">

        <!-- Tab content -->
        <div class="tab-content">
            <!-- Unassigned Students Tab -->
            <div class="tab-pane fade show active" id="unassigned">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="section-title">Danh sách sinh viên chưa phân lớp</h5>
                    </div>
                    <div class="card-body">
                        @if($unassignedStudents->isEmpty())
                            <div class="alert alert-info">Không có sinh viên nào chưa được phân lớp</div>
                        @else
                            <div class="table-responsive">
                                <table class="student-table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên đăng nhập</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($unassignedStudents as $student)
                                        <tr>
                                            <td>{{ $student->id_nguoidung }}</td>
                                            <td>{{ $student->ten_dang_nhap }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->so_dien_thoai }}</td>
                                            <td>
                                                <span class="status-badge {{ $student->trang_thai === 'hoạt động' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $student->trang_thai }}
                                                </span>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-assign"
                                                        onclick="showAssignForm({{ $student->id_nguoidung }}, '{{ $student->ten_dang_nhap }}')">
                                                    <i class="fas fa-user-plus"></i> Phân lớp
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>

                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="section-title">Danh sách sinh viên đã được phân lớp</h5>
                    </div>
                    <div class="card-body">
                        @if($assignedStudents->isEmpty())
                            <div class="alert alert-info">Không có sinh viên nào đã được phân lớp</div>
                        @else
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên đăng nhập</th>
                                        <th>Email</th>
                                        <th>Lớp hiện tại</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($unassignedStudents as $student)
                                        <tr>
                                            <td>{{ $student->id_nguoidung }}</td>
                                            <td>{{ $student->ten_dang_nhap }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>Chưa phân lớp</td>
                                            <td>
                                                <button class="btn btn-primary"
                                                        onclick="showAssignForm(
                                    '{{ $student->id_nguoidung }}',
                                    '{{ $student->ten_dang_nhap }}'
                                )">
                                                    <i class="fas fa-user-plus"></i> Phân lớp
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @foreach($assignedStudents as $student)
                                        <tr>
                                            <td>{{ $student->id_nguoidung }}</td>
                                            <td>{{ $student->ten_dang_nhap }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->ten_lop }}</td>
                                            <td>
                                                <button class="btn btn-info"
                                                        onclick="showAssignForm(
                                    '{{ $student->id_nguoidung }}',
                                    '{{ $student->ten_dang_nhap }}',
                                    '{{ $student->ten_lop }}'
                                )">
                                                    <i class="fas fa-exchange-alt"></i> Chuyển lớp
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>


        </div>
    </div>


    <!-- Assignment Modal -->
    <div class="modal fade" id="assignModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Phân lớp sinh viên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="assignForm" method="POST" action="{{ route('sinhvien.assign') }}">
                        @csrf
                        <input type="hidden" id="studentId" name="id_nguoidung">
                        <input type="hidden" id="ten_sinhvien" name="ten_sinhvien">

                        <div class="mb-3">
                            <label class="form-label">Tên đăng nhập</label>
                            <input type="text" id="studentUsername" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Lớp hiện tại</label>
                            <input type="text" id="currentLop" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Chọn lớp mới</label>
                            <select name="id_lop" class="form-control" required>
                                <option value="">-- Chọn lớp --</option>
                                @foreach($lops as $lop)
                                    <option value="{{ $lop->id_lop }}">{{ $lop->ten_lop }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function showAssignForm(studentId, studentName, currentLop = '') {
            // Set values in form
            document.getElementById('studentId').value = studentId;
            document.getElementById('studentUsername').value = studentName;
            document.getElementById('ten_sinhvien').value = studentName; // Set ten_sinhvien same as ten_dang_nhap
            document.getElementById('currentLop').value = currentLop || 'Chưa phân lớp';

            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('assignModal'));
            modal.show();
        }
    </script>
@endsection
