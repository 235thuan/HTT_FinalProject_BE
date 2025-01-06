@extends('layouts.vertical', ['title' => 'Danh sách sinh viên'])

@section('css')
<style>
.highlight-row {
    animation: highlight 3s;
}
@keyframes highlight {
    0% { background-color: #fff3cd; }
    100% { background-color: transparent; }
}
</style>
@endsection

@section('content')
@include('layouts.shared.page-title', ['page_title' => 'Danh sách lớp', 'sub_title' => 'Quản lý người dùng'])

<div class="container-fluid">
    <div class="row">
        <div class=" mb-3">
            <div class="col-12">
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addSinhVienModal">
                    <i class="mdi mdi-plus-circle me-1"></i> Thêm mới sinh viên
                </button>
            </div>
        </div>
    </div>

    <div id="student-lists">
        @include('qlnd.partials.student-list')
    </div>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="addSinhVienModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm mới sinh viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addSinhVienForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" name="ten_sinhvien" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email_input" required>
                                <small id="email_status" class="form-text"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" name="so_dien_thoai" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Lớp</label>
                                <select class="form-select" name="id_lop" id="select_lop" required>
                                    <option value="">Chọn lớp</option>
                                </select>
                                <small class="text-muted">
                                    Chuyên ngành: <span id="chuyennganh_info">-</span> |
                                    Năm vào học: <span id="namvaohoc_info">-</span>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if(isset($findStudent))
<script>
$(document).ready(function() {
    var studentRow = $(`tr[data-student-id="{{ $findStudent }}"]`);
    if (studentRow.length) {
        // Calculate if the student is in viewport
        var rowTop = studentRow.offset().top;
        var windowTop = $(window).scrollTop();
        var windowBottom = windowTop + $(window).height();

        // Only scroll if the student is not already visible
        if (rowTop < windowTop || rowTop > windowBottom) {
            $('html, body').animate({
                scrollTop: rowTop - 100
            }, 500);
        }

        studentRow.addClass('highlight-row');
        setTimeout(() => studentRow.removeClass('highlight-row'), 3000);
    }
});
</script>
@endif

@push('scripts')
<script>

$(document).ready(function() {
    // Gọi lại khi mở modal
    $('#addSinhVienModal').on('show.bs.modal', function() {
        loadLopList();
    });

// Hàm lấy danh sách lớp
    function loadLopList() {
        console.log('run load lop');
        $.ajax({
            url: '{{ route("sinhvien.getLopLists") }}',
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    let selectLop = $('#select_lop');
                    selectLop.empty().append('<option value="">Chọn lớp</option>');

                    response.data.data.forEach(function(lop) {
                        selectLop.append(`<option value="${lop.id_lop}"
                        data-chuyennganh="${lop.ten_chuyennganh}"
                        data-namvaohoc="${lop.nam_vao_hoc}">
                        ${lop.ten_lop}
                    </option>`);
                    });
                }
            },
            error: function(xhr) {
                console.error('Lỗi khi lấy danh sách lớp:', xhr);
            }
        });
    }

// Cập nhật thông tin chuyên ngành và năm vào học khi chọn lớp
    $('#select_lop').on('change', function() {
        let selectedOption = $(this).find('option:selected');
        $('#chuyennganh_info').text(selectedOption.data('chuyennganh') || '-');
        $('#namvaohoc_info').text(selectedOption.data('namvaohoc') || '-');
    });





    // Store all lops grouped by chuyenNganh
    var lopsByChuyenNganh = @json($lopsByChuyenNganh);
    var chuyenNganhs = @json($chuyenNganhs);

    // Handle chuyenNganh selection change
    $('#select_chuyennganh').on('change', function() {
        var chuyenNganhId = $(this).val();
        var lopSelect = $('#select_lop');

        // Clear and disable lop select
        lopSelect.empty().append('<option value="">Chọn lớp</option>');

        if (chuyenNganhId) {
            // Enable lop select
            lopSelect.prop('disabled', false);

            // Get lops for selected chuyenNganh
            var lops = lopsByChuyenNganh[chuyenNganhId] || [];

            // Get the selected chuyenNganh info
            var selectedChuyenNganh = chuyenNganhs.find(cn => cn.id_chuyennganh == chuyenNganhId);

            if (selectedChuyenNganh) {
                // Sort lops by name
                lops.sort((a, b) => a.ten_lop.localeCompare(b.ten_lop));

                // Add all matching lops
                lops.forEach(function(lop) {
                    lopSelect.append(`<option value="${lop.ten_lop}">${lop.ten_lop}</option>`);
                });
            }
        } else {
            // Disable lop select if no chuyenNganh selected
            lopSelect.prop('disabled', true);
        }
    });

    // Add email check functionality
    var emailTimeout;
    $('#email_input').on('input', function() {
        clearTimeout(emailTimeout);
        var email = $(this).val();
        var statusElement = $('#email_status');

        if (email && email.includes('@')) {
            statusElement.html('<i class="mdi mdi-loading mdi-spin"></i> Đang kiểm tra...')
                .removeClass('text-success text-danger text-warning')
                .addClass('text-muted');

            emailTimeout = setTimeout(function() {
                $.ajax({
                    url: '{{ route("check.email") }}',
                    type: 'GET',
                    data: { email: email },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.exists) {
                            if (response.canUse) {
                                statusElement.html(`<i class="mdi mdi-check-circle"></i> ${response.message}`)
                                    .removeClass('text-muted text-danger')
                                    .addClass('text-success');
                            } else {
                                statusElement.html(`<i class="mdi mdi-alert"></i> ${response.message}`)
                                    .removeClass('text-muted text-success')
                                    .addClass('text-danger');
                                $('#email_input').addClass('is-invalid');
                            }
                        } else {
                            statusElement.html(`<i class="mdi mdi-information"></i> ${response.message}`)
                                .removeClass('text-muted text-danger')
                                .addClass('text-success');
                            $('#email_input').removeClass('is-invalid');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        statusElement.html('<i class="mdi mdi-alert"></i> Lỗi kiểm tra email')
                            .removeClass('text-muted text-success')
                            .addClass('text-danger');
                    }
                });
            }, 500);
        } else {
            statusElement.empty();
            $('#email_input').removeClass('is-invalid');
        }
    });

    // Handle form submission
    $('#addSinhVienForm').on('submit', function(e) {
        e.preventDefault();

        // Disable submit button to prevent double submission
        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true);

        // Get form data
        const formData = $(this).serialize();

        $.ajax({
            url: '{{ route("sinhvien.store") }}',
            method: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Show success message
                    toastr.success(response.message || 'Thêm sinh viên thành công');

                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addSinhVienModal'));
                    modal.hide();

                    // Clean up modal
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open').css('padding-right', '');

                    // Reload page after short delay
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                } else {
                    toastr.error(response.message || 'Có lỗi xảy ra');
                }
            },
            error: function(xhr) {
                // Enable submit button again
                submitBtn.prop('disabled', false);

                if (xhr.status === 422) {
                    // Validation errors
                    const errors = xhr.responseJSON.errors;
                    Object.keys(errors).forEach(function(key) {
                        toastr.error(errors[key][0]);
                        $(`[name="${key}"]`).addClass('is-invalid');
                    });
                } else {
                    // General error
                    toastr.error('Có lỗi xảy ra khi thêm sinh viên');
                }
            },
            complete: function() {
                // Enable submit button in any case
                submitBtn.prop('disabled', false);
            }
        });
    });

// Clear validation errors when input changes
    $('#addSinhVienForm input, #addSinhVienForm select').on('input change', function() {
        $(this).removeClass('is-invalid');
    });

    // Reset form when modal is closed
    $('#addSinhVienModal').on('hidden.bs.modal', function() {
        $('#addSinhVienForm')[0].reset();
        $('#select_lop').prop('disabled', true).empty().append('<option value="">Chọn lớp</option>');
    });
});


</script>
@endpush
@endsection
