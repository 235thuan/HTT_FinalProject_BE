@extends('layouts.vertical', ['title' => 'Sửa miễn giảm học phí'])


@section('css')
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <!-- Select2 Bootstrap 5 Theme -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-5-theme/1.3.0/select2-bootstrap-5.min.css">
    <!-- DateRangePicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.1/sweetalert2.min.css">
    <style>
        .daterangepicker {
            z-index: 1100 !important;
        }
        .daterangepicker .calendar-table {
            background-color: white;
        }
        .daterangepicker td.active,
        .daterangepicker td.active:hover {
            background-color: #727cf5;
        }
    </style>
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
                    <h4 class="page-title">Sửa miễn giảm học phí</h4>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('miengiam.update', $mienGiam->id_mien_giam) }}" method="POST"
                              id="mien-giam-form">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="id_mien_giam" value="{{ $mienGiam->id_mien_giam }}">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="id_monhoc" class="form-label">Môn học <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control select2" id="id_monhoc" name="id_monhoc" required>
                                            <option value="">Chọn môn học</option>
                                            @foreach($monHocList as $mh)
                                                <option value="{{ $mh->id_monhoc }}"
                                                    {{ $mienGiam->id_monhoc == $mh->id_monhoc ? 'selected' : '' }}>
                                                    {{ $mh->ten_monhoc }} ({{ $mh->so_tin_chi }} tín chỉ)
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_monhoc')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="ty_le_mien_giam" class="form-label">Tỷ lệ miễn giảm (%) <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="ty_le_mien_giam"
                                               name="ty_le_mien_giam" value="{{ $mienGiam->ty_le_mien_giam }}"
                                               min="0" max="100" step="0.01" required>
                                        @error('ty_le_mien_giam')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="so_tien_mien_giam" class="form-label">Số tiền miễn giảm cố
                                            định</label>
                                        <input type="number" class="form-control" id="so_tien_mien_giam"
                                               name="so_tien_mien_giam" value="{{ $mienGiam->so_tien_mien_giam }}"
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
                                                   value="{{ old('ngay_bat_dau', $mienGiam->ngay_bat_dau ? date('Y-m-d', strtotime($mienGiam->ngay_bat_dau)) : '') }}"
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
                                                   value="{{ old('ngay_ket_thuc', $mienGiam->ngay_ket_thuc ? date('Y-m-d', strtotime($mienGiam->ngay_ket_thuc)) : '') }}"
                                                   min="{{ date('Y-m-d') }}">
                                        </div>
                                        <small class="text-muted">Để trống nếu không có ngày kết thúc</small>
                                        @error('ngay_ket_thuc')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="mo_ta" class="form-label">Mô tả <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="mo_ta" name="mo_ta" rows="3" required>{{ $mienGiam->mo_ta }}</textarea>
                                        @error('mo_ta')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="trang_thai" class="form-label">Trạng thái</label>
                                        <select class="form-control" id="trang_thai" name="trang_thai">
                                            <option value="active" {{ $mienGiam->trang_thai == 'active' ? 'selected' : '' }}>
                                                Đang áp dụng
                                            </option>
                                            <option value="inactive" {{ $mienGiam->trang_thai == 'inactive' ? 'selected' : '' }}>
                                                Ngừng áp dụng
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-check"></i> Cập nhật
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Make sure jQuery is loaded first -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Then SweetAlert2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.1/sweetalert2.min.js"></script>
    <!-- Then your custom script -->
    <script>
        // Your delete function here
    </script>
@endpush
