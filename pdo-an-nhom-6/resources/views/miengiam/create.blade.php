@extends('layouts.vertical', ['title' => 'Thêm miễn giảm học phí'])


@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('miengiam.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Quay lại
                        </a>
                    </div>
                    <h4 class="page-title">Thêm miễn giảm học phí</h4>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('miengiam.store') }}" method="POST" id="mien-giam-form">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="id_monhoc" class="form-label">Môn học <span class="text-danger">*</span></label>
                                        <select class="form-control select2" id="id_monhoc" name="id_monhoc" required>
                                            <option value="">Chọn môn học</option>
                                            @foreach($monHocList as $mh)
                                                <option value="{{ $mh->id_monhoc }}"
                                                    {{ old('id_monhoc') == $mh->id_monhoc ? 'selected' : '' }}>
                                                    {{ $mh->ten_monhoc }} ({{ $mh->so_tin_chi }} tín chỉ)
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_monhoc')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="ty_le_mien_giam" class="form-label">Tỷ lệ miễn giảm (%) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="ty_le_mien_giam"
                                               name="ty_le_mien_giam" value="{{ old('ty_le_mien_giam') }}"
                                               min="0" max="100" step="0.01" required>
                                        @error('ty_le_mien_giam')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="so_tien_mien_giam" class="form-label">Số tiền miễn giảm cố định</label>
                                        <input type="number" class="form-control" id="so_tien_mien_giam"
                                               name="so_tien_mien_giam" value="{{ old('so_tien_mien_giam') }}"
                                               min="0" step="1000">
                                        @error('so_tien_mien_giam')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="ngay_bat_dau" class="form-label">Ngày bắt đầu <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="date"
                                                   class="form-control"
                                                   id="ngay_bat_dau"
                                                   name="ngay_bat_dau"
                                                   value="{{ old('ngay_bat_dau', date('Y-m-d')) }}"
                                                   min="{{ date('Y-m-d') }}"
                                                   required>

                                        </div>
                                        @error('ngay_bat_dau')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="ngay_ket_thuc" class="form-label">Ngày kết thúc</label>
                                        <div class="input-group">
                                            <input type="date"
                                                   class="form-control"
                                                   id="ngay_ket_thuc"
                                                   name="ngay_ket_thuc"
                                                   value="{{ old('ngay_ket_thuc') }}"
                                                   min="{{ date('Y-m-d') }}">

                                        </div>
                                        <small class="text-muted">Để trống nếu không có ngày kết thúc</small>
                                        @error('ngay_ket_thuc')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="mo_ta" class="form-label">Mô tả <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="mo_ta" name="mo_ta"
                                                  rows="3" required>{{ old('mo_ta') }}</textarea>
                                        @error('mo_ta')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-check"></i> Lưu miễn giảm
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/vn.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2();

            // Initialize Flatpickr
            $('.flatpickr').flatpickr({
                locale: 'vn',
                dateFormat: 'Y-m-d',
                minDate: 'today'
            });

            // Form validation
            $('#mien-giam-form').submit(function(e) {
                e.preventDefault(); // Prevent form submission initially

                var form = $(this);
                var ngayBatDau = $('#ngay_bat_dau').val();
                var ngayKetThuc = $('#ngay_ket_thuc').val();
                var idMonHoc = $('#id_monhoc').val();
                var idMienGiam = $('#id_mien_giam').val(); // For edit form

                // Basic date validation
                if (ngayKetThuc && ngayBatDau >= ngayKetThuc) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: 'Ngày kết thúc phải sau ngày bắt đầu'
                    });
                    return;
                }

                // Check for overlapping dates
                $.ajax({
                    url: '{{ route("miengiam.checkOverlap") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id_monhoc: idMonHoc,
                        ngay_bat_dau: ngayBatDau,
                        ngay_ket_thuc: ngayKetThuc,
                        id_mien_giam: idMienGiam // Include when editing
                    },
                    success: function(response) {
                        if (response.overlap) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi!',
                                text: response.message
                            });
                        } else {
                            // If no overlap, submit the form
                            form.off('submit').submit();
                        }
                    },
                    error: function(xhr) {
                        var message = 'Có lỗi xảy ra khi kiểm tra trùng lặp';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: message
                        });
                    }
                });
            });
        });
    </script>
@endsection
