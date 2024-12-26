@extends('layouts.vertical', ['title' => 'Quản lý miễn giảm học phí'])

@push('css')
    <!-- Bootstrap Datepicker CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css"
          rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Tiêu đề -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Quản lý miễn giảm học phí</h4>
                </div>
            </div>
        </div>

        <!-- Card chính -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                        data-bs-target="#discountModal">
                                    <i class="mdi mdi-plus-circle me-2"></i> Thêm miễn giảm
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>Môn học</th>
                                    <th>Tỷ lệ/Số tiền</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Mô tả</th>
                                    <th style="width: 82px">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($discounts as $discount)
                                    <tr>
                                        <td>
                                            <span class="fw-semibold">{{ $discount->ten_monhoc }}</span>
                                            <br>
                                            <small class="text-muted">{{ $discount->so_tin_chi }} tín chỉ</small>
                                        </td>
                                        <td>
                                            @if($discount->ty_le_mien_giam !== null)
                                                {{ $discount->ty_le_mien_giam }}%
                                            @else
                                                {{ number_format($discount->so_tien_mien_giam, 0, ',', '.') }}đ
                                            @endif
                                        </td>
                                        <td>
                                            {{ $discount->ngay_bat_dau }}
                                        </td>
                                        <td>
                                            {{ $discount->ngay_ket_thuc }}
                                        </td>
                                        <td>{{ $discount->mo_ta }}</td>
                                        <td>
                                            <button type="button"
                                                    class="btn btn-info btn-sm"
                                                    onclick="editDiscount({{ $discount->id_mien_giam }})">
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </button>
                                            <button type="button"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="deleteDiscount({{ $discount->id_mien_giam }})">
                                                <i class="mdi mdi-delete"></i>
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
    </div>

    <!-- Modal Form -->
    <div class="modal fade" id="discountModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="discountForm" onsubmit="return validateDiscountForm(this)">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm miễn giảm học phí</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Môn học</label>
                            <select class="form-select" name="id_monhoc" required>
                                <option value="">Chọn môn học</option>
                                @foreach($monhocs as $monhoc)
                                    <option value="{{ $monhoc->id_monhoc }}">
                                        {{ $monhoc->ten_monhoc }} ({{ $monhoc->so_tin_chi }} tín chỉ)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Loại miễn giảm</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="typePercent" name="discount_type" value="percent"
                                           class="form-check-input" checked>
                                    <label class="form-check-label" for="typePercent">Theo tỷ lệ</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="typeFixed" name="discount_type" value="fixed"
                                           class="form-check-input">
                                    <label class="form-check-label" for="typeFixed">Số tiền cố định</label>
                                </div>
                            </div>
                        </div>

                        <div id="percentageGroup" class="mb-3">
                            <label class="form-label">Tỷ lệ miễn giảm (%)</label>
                            <input type="number" class="form-control" name="ty_le_mien_giam" min="0" max="100">
                        </div>

                        <div id="fixedAmountGroup" class="mb-3 d-none">
                            <label class="form-label">Số tiền miễn giảm</label>
                            <input type="number" class="form-control" name="so_tien_mien_giam" min="0">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ngày bắt đầu</label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="ngay_bat_dau" required>
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ngày kết thúc</label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="ngay_ket_thuc">
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control" name="mo_ta" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Bootstrap Datepicker JS -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.vi.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        window.addEventListener('load', function () {
            // Kiểm tra jQuery và datepicker
            if (typeof jQuery === 'undefined') {
                console.error('jQuery is not loaded!');
                return;
            }
            if (typeof jQuery.fn.datepicker === 'undefined') {
                console.error('Bootstrap Datepicker is not loaded!');
                return;
            }

            // Khởi tạo datepicker
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
                language: 'vi'
            });

            // Handle discount type change
            $('input[name="discount_type"]').change(function () {
                const isPercent = $(this).val() === 'percent';
                $('#percentageGroup').toggleClass('d-none', !isPercent);
                $('#fixedAmountGroup').toggleClass('d-none', isPercent);
            });
        });

        $(document).ready(function () {


            // Xử lý thay đổi loại miễn giảm
            $('input[name="discount_type"]').change(function () {
                const type = $(this).val();
                if (type === 'percent') {
                    $('#percentageGroup').removeClass('d-none');
                    $('#fixedAmountGroup').addClass('d-none');
                    $('input[name="so_tien_mien_giam"]').val('');
                } else {
                    $('#percentageGroup').addClass('d-none');
                    $('#fixedAmountGroup').removeClass('d-none');
                    $('input[name="ty_le_mien_giam"]').val('');
                }
            });

            // Xử lý submit form
            $('#discountForm').on('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(this);
                const url = $(this).attr('action') || '/thuan/hocphi/discount';
                const method = $(this).attr('action') ? 'PUT' : 'POST';

                if (method === 'PUT') {
                    formData.append('_method', 'PUT');
                }

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thành công',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi',
                                text: response.message
                            });
                        }
                    },
                    error: function (xhr) {
                        let errorMessage = 'Có lỗi xảy ra';
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMessage = Object.values(xhr.responseJSON.errors).flat().join('\n');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: errorMessage
                        });
                    }
                });
            });
        });

        function editDiscount(id) {
            try {
                $.ajax({
                    url: `/thuan/hocphi/discount/${id}`,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            const discount = response.data;
                            const form = $('#discountModal form');

                            // Reset form
                            form[0].reset();

                            // Fill data
                            form.find('select[name="id_monhoc"]').val(discount.id_monhoc);

                            // Set discount type
                            if (discount.ty_le_mien_giam !== null) {
                                form.find('input[name="discount_type"][value="percent"]').prop('checked', true).trigger('change');
                                form.find('input[name="ty_le_mien_giam"]').val(discount.ty_le_mien_giam);
                            } else {
                                form.find('input[name="discount_type"][value="fixed"]').prop('checked', true).trigger('change');
                                form.find('input[name="so_tien_mien_giam"]').val(discount.so_tien_mien_giam);
                            }

                            // Set dates directly without datepicker methods
                            form.find('input[name="ngay_bat_dau"]').val(discount.ngay_bat_dau);
                            if (discount.ngay_ket_thuc) {
                                form.find('input[name="ngay_ket_thuc"]').val(discount.ngay_ket_thuc);
                            }

                            form.find('textarea[name="mo_ta"]').val(discount.mo_ta);

                            // Update form action
                            form.attr('action', `/thuan/hocphi/discount/${id}`);

                            // Update modal title
                            $('#discountModal .modal-title').text('Cập nhật miễn giảm học phí');

                            // Show modal
                            $('#discountModal').modal('show');

                            // Initialize datepicker after modal is shown
                            $('#discountModal').on('shown.bs.modal', function () {
                                $('.datepicker').each(function () {
                                    if ($.fn.datepicker) {
                                        $(this).datepicker({
                                            format: 'dd/mm/yyyy',
                                            autoclose: true,
                                            todayHighlight: true,
                                            language: 'vi'
                                        });
                                    }
                                });
                            });

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi',
                                text: response.message || 'Không thể tải thông tin miễn giảm'
                            });
                        }
                    },
                    error: function (xhr) {
                        console.error('Error:', xhr);
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: xhr.responseJSON?.message || 'Không thể tải thông tin miễn giảm'
                        });
                    }
                });
            } catch (error) {
                console.error('Error in editDiscount:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Không thể tải thông tin miễn giảm'
                });
            }
        }

        function deleteDiscount(id) {
            Swal.fire({
                title: 'Xác nhận xóa?',
                text: "Bạn không thể hoàn tác sau khi xóa!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/thuan/hocphi/discount/${id}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Đã xóa!',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi!',
                                    text: response.message
                                });
                            }
                        },
                        error: function (xhr) {
                            console.error('Delete error:', xhr);
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi!',
                                text: 'Không thể xóa miễn giảm'
                            });
                        }
                    });
                }
            });
        }

        function validateDiscountForm(form) {
            const $form = $(form);
            let isValid = true;
            const errors = [];

            // Reset previous errors
            $form.find('.is-invalid').removeClass('is-invalid');
            $form.find('.invalid-feedback').remove();

            // Validate môn học
            if (!$form.find('select[name="id_monhoc"]').val()) {
                errors.push('Vui lòng chọn môn học');
                $form.find('select[name="id_monhoc"]').addClass('is-invalid');
                isValid = false;
            }

            // Validate loại miễn giảm
            const discountType = $form.find('input[name="discount_type"]:checked').val();
            if (discountType === 'percent') {
                const percent = $form.find('input[name="ty_le_mien_giam"]').val();
                if (!percent || percent < 0 || percent > 100) {
                    errors.push('Tỷ lệ miễn giảm phải từ 0 đến 100');
                    $form.find('input[name="ty_le_mien_giam"]').addClass('is-invalid');
                    isValid = false;
                }
            } else {
                const amount = $form.find('input[name="so_tien_mien_giam"]').val();
                if (!amount || amount < 0) {
                    errors.push('Số tiền miễn giảm không hợp lệ');
                    $form.find('input[name="so_tien_mien_giam"]').addClass('is-invalid');
                    isValid = false;
                }
            }

            // Validate ngày
            const startDate = $form.find('input[name="ngay_bat_dau"]').val();
            if (!startDate) {
                errors.push('Vui lòng chọn ngày bắt đầu');
                $form.find('input[name="ngay_bat_dau"]').addClass('is-invalid');
                isValid = false;
            }

            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Vui lòng kiểm tra lại thông tin',
                    html: errors.join('<br>')
                });
            }

            return isValid;
        }

        // Reset form when modal is closed
        $('#discountModal').on('hidden.bs.modal', function () {
            const form = $(this).find('form');
            form[0].reset();
            form.attr('action', '');
            form.find('.is-invalid').removeClass('is-invalid');
            form.find('.invalid-feedback').remove();
            $(this).find('.modal-title').text('Thêm miễn giảm học phí');

            // Re-initialize datepickers after modal is closed
            form.find('.datepicker').datepicker('destroy');
            initializeDatepicker(form.find('.datepicker'));
        });
    </script>
@endpush
