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
                                <label class="form-label">Chuyên ngành</label>
                                <select class="form-select" name="ma_chuyen_nganh" id="select_chuyennganh" required>
                                    <option value="">Chọn chuyên ngành</option>
                                    @foreach($chuyenNganhs as $cn)
                                        <option value="{{ $cn->id_chuyennganh }}">{{ $cn->ten_chuyennganh }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Lớp</label>
                                <select class="form-select" name="lop" id="select_lop" required disabled>
                                    <option value="">Chọn lớp</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Năm vào học</label>
                                <input type="number" class="form-control" name="nam_vao_hoc" 
                                       min="2000" max="{{ date('Y') }}" required>
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
        
        $.ajax({
            url: '{{ route("sinhvien.store") }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    // Properly close modal and clean up
                    var modal = bootstrap.Modal.getInstance(document.getElementById('addSinhVienModal'));
                    modal.hide();
                    
                    // Remove modal backdrop and reset body
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');
                    $('body').css('padding-right', '');
                    
                    // Show success message
                    toastr.success('Thêm sinh viên thành công!');
                    
                    // Wait a short moment then redirect
                    setTimeout(function() {
                        window.location = '/qlnd/listSinhvien';
                    }, 1000);
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                Object.keys(errors).forEach(function(key) {
                    toastr.error(errors[key][0]);
                });
            }
        });
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