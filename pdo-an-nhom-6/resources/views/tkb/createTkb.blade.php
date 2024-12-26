@extends('layouts.vertical', ['title' => 'Thêm lịch học mới'])

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-label.required:after {
            content: " *";
            color: red;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Quay lại
                        </a>
                    </div>
                    <h4 class="page-title">Thêm lịch học mới</h4>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                <h5 class="alert-heading">Không thể tạo lịch học:</h5>
                <div class="mt-2">
                    {!! session('error') !!}
                </div>
            </div>
        @endif
        <!-- Form -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('schedule.store') }}" method="POST" id="scheduleForm">
                            @csrf

                            <!-- Môn học -->
                            <div class="mb-3">
                                <label for="id_monhoc" class="form-label required">Môn học</label>
                                <select class="form-control" name="id_monhoc" id="id_monhoc" required>
                                    <option value="">-- Chọn môn học --</option>
                                    @foreach($monhocs as $monhoc)
                                        <option value="{{ $monhoc->id_monhoc }}"
                                            {{ old('id_monhoc') == $monhoc->id_monhoc ? 'selected' : '' }}>
                                            {{ $monhoc->ten_monhoc }} ({{ $monhoc->so_tin_chi }} tín chỉ)
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Giáo viên -->
                            <div class="mb-3">
                                <label for="id_giaovien" class="form-label required">Giáo viên</label>
                                <select class="form-control" name="id_giaovien" id="id_giaovien" required>
                                    <option value="">-- Chọn giáo viên --</option>
                                    @foreach($giaoviens as $giaovien)
                                        <option value="{{ $giaovien->id_giaovien }}"
                                            {{ old('id_giaovien') == $giaovien->id_giaovien ? 'selected' : '' }}>
                                            {{ $giaovien->ten_giaovien }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Lớp học -->
                            <div class="mb-3">
                                <label for="id_lop" class="form-label required">Lớp</label>
                                <select class="form-control" name="id_lop" id="id_lop" required>
                                    <option value="">-- Chọn lớp --</option>
                                    @foreach($lops as $lop)
                                        <option value="{{ $lop->id_lop }}"
                                            {{ old('id_lop') == $lop->id_lop ? 'selected' : '' }}>
                                            {{ $lop->ten_lop }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Phòng học -->
                            <div class="mb-3">
                                <label for="id_phonghoc" class="form-label required">Phòng học</label>
                                <select class="form-control" name="id_phonghoc" id="id_phonghoc" required>
                                    <option value="">-- Chọn phòng học --</option>
                                    @foreach($phonghocs as $phonghoc)
                                        <option value="{{ $phonghoc->id_phonghoc }}"
                                            {{ old('id_phonghoc') == $phonghoc->id_phonghoc ? 'selected' : '' }}>
                                            {{ $phonghoc->ten_phonghoc }}
                                            @if($phonghoc->khu_vuc)
                                                ({{ $phonghoc->khu_vuc }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Thời gian học -->
                            <div class="row">
                                <!-- Ngày học -->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="ngay_hoc" class="form-label required">Ngày học</label>
                                        <input type="date" class="form-control"
                                               name="ngay_hoc" id="ngay_hoc"
                                               value="{{ old('ngay_hoc') }}"
                                               min="{{ date('Y-m-d') }}"
                                               required>
                                    </div>
                                </div>

                                <!-- Giờ bắt đầu -->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="gio_bat_dau" class="form-label required">Giờ bắt đầu</label>
                                        <input type="time" class="form-control"
                                               name="gio_bat_dau" id="gio_bat_dau"
                                               value="{{ old('gio_bat_dau') }}"
                                               required>
                                    </div>
                                </div>

                                <!-- Giờ kết thúc -->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="gio_ket_thuc" class="form-label required">Giờ kết thúc</label>
                                        <input type="time" class="form-control"
                                               name="gio_ket_thuc" id="gio_ket_thuc"
                                               value="{{ old('gio_ket_thuc') }}"
                                               required>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit buttons -->
                            <div class="text-end">
                                <button type="reset" class="btn btn-secondary me-2">Làm mới</button>
                                <button type="submit" class="btn btn-primary">Thêm lịch học</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.getElementById('scheduleForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Kiểm tra thời gian
            const gioBatDau = document.getElementById('gio_bat_dau').value;
            const gioKetThuc = document.getElementById('gio_ket_thuc').value;

            if (gioBatDau >= gioKetThuc) {
                alert('Giờ kết thúc phải sau giờ bắt đầu');
                return;
            }

            // Nếu hợp lệ thì submit form
            this.submit();
        });
    </script>
    <script>
        let timeoutId;

        // Hàm kiểm tra xung đột
        async function checkConflicts() {
            const formData = {
                id_giaovien: document.getElementById('id_giaovien').value,
                id_lop: document.getElementById('id_lop').value,
                id_phonghoc: document.getElementById('id_phonghoc').value,
                ngay_hoc: document.getElementById('ngay_hoc').value,
                gio_bat_dau: document.getElementById('gio_bat_dau').value,
                gio_ket_thuc: document.getElementById('gio_ket_thuc').value,
            };

            // Kiểm tra nếu thiếu thông tin
            if (!formData.id_giaovien || !formData.id_lop || !formData.ngay_hoc ||
                !formData.gio_bat_dau || !formData.gio_ket_thuc) {
                return;
            }

            try {
                const response = await fetch('{{ route("schedule.checkConflicts") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(formData)
                });

                const result = await response.json();

                // Xóa thông báo cũ
                clearValidationMessages();

                if (!result.success) {
                    // Hiển thị các lỗi xung đột
                    showValidationMessages(result.conflicts);
                    return false;
                }

                return true;

            } catch (error) {
                console.error('Error checking conflicts:', error);
                return false;
            }
        }

        // Hàm hiển thị thông báo lỗi
        function showValidationMessages(conflicts) {
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-warning mt-3';
            alertDiv.id = 'conflictAlert';

            let messageHtml = '<ul class="mb-0">';
            if (conflicts.teacher) {
                messageHtml += `<li>Giáo viên đã có lịch dạy lớp ${conflicts.teacher} trong thời gian này</li>`;
            }
            if (conflicts.class) {
                messageHtml += `<li>Lớp đã có lịch học môn khác trong thời gian này</li>`;
            }
            if (conflicts.room) {
                messageHtml += `<li>Phòng học đã được sử dụng cho lớp ${conflicts.room} trong thời gian này</li>`;
            }
            messageHtml += '</ul>';

            alertDiv.innerHTML = messageHtml;
            document.getElementById('scheduleForm').insertBefore(alertDiv, document.querySelector('button[type="submit"]').parentNode);
        }

        // Hàm xóa thông báo lỗi
        function clearValidationMessages() {
            const existingAlert = document.getElementById('conflictAlert');
            if (existingAlert) {
                existingAlert.remove();
            }
        }

        // Thêm sự kiện cho các trường input
        const inputFields = ['id_giaovien', 'id_lop', 'id_phonghoc', 'ngay_hoc', 'gio_bat_dau', 'gio_ket_thuc'];
        inputFields.forEach(fieldId => {
            document.getElementById(fieldId).addEventListener('change', () => {
                // Debounce the check to avoid too many requests
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => checkConflicts(), 500);
            });
        });

        // Xử lý submit form
        document.getElementById('scheduleForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            // Kiểm tra thời gian
            const gioBatDau = document.getElementById('gio_bat_dau').value;
            const gioKetThuc = document.getElementById('gio_ket_thuc').value;

            if (gioBatDau >= gioKetThuc) {
                alert('Giờ kết thúc phải sau giờ bắt đầu');
                return;
            }

            // Kiểm tra xung đột trước khi submit
            const isValid = await checkConflicts();
            if (isValid) {
                this.submit();
            }
        });
    </script>
@endpush

<
