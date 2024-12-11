@extends('layouts.vertical', ['title' => 'Danh sách giáo viên', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
<style>
.highlight-row {
    animation: highlightRow 3s;
}

@keyframes highlightRow {
    0% { background-color: #fff3cd; }
    100% { background-color: transparent; }
}

.card {
    margin-bottom: 24px;
}

.card-header {
    padding: 1rem 1.5rem;
    background-color: #fff;
}



/* Add these styles for better form layout */
.modal-body .form-group {
    margin-bottom: 1rem;
}



.form-select:disabled {
    background-color: #e9ecef;
    opacity: 1;
}
</style>
@endsection

@section('content')
@include('layouts.shared.page-title', ['page_title' => 'Danh sách giáo viên', 'sub_title' => 'Quản lý người dùng'])

<div class="row mb-3">
    <div class="col-12">
        <button type="button" 
                class="btn btn-primary float-end" 
                data-bs-toggle="modal" 
                data-bs-target="#addTeacherModal"
                data-khoa="{{ $khoas->first()->id_khoa }}"
                data-khoa-name="{{ $khoas->first()->ten_khoa }}">
            <i class="mdi mdi-plus"></i> Thêm giáo viên
        </button>
    </div>
</div>

<div class="row">
    @foreach($khoas as $khoa)
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="header-title">{{ $khoa->ten_khoa }}  <span class="badge bg-primary ms-2">
                        {{ $khoa->total_teachers }} giáo viên
                    </span></h4>
                   
                </div>

                <div class="card-body" id="teacher-list-{{ $khoa->id_khoa }}">
                    @include('qlnd.partials.teacher-list', [
                        'teachers' => $khoa->teachers,
                        'khoa' => $khoa
                    ])
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Add Teacher Modal -->
<div class="modal fade" id="addTeacherModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm Giáo Viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addTeacherForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Tên giáo viên</label>
                                <input type="text" class="form-control" name="ten_giaovien" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Khoa</label>
                                <select class="form-select" name="ma_khoa" id="add_ma_khoa" required>
                                    <option value="">Chọn khoa</option>
                                    @foreach($khoas as $khoa)
                                        <option value="{{ $khoa->id_khoa }}">{{ $khoa->ten_khoa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" name="so_dien_thoai" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Môn học phụ trách</label>
                        <select class="form-select" name="ma_monhoc[]" id="add_ma_monhoc" multiple required>
                            <option value="">Chọn môn học</option>
                        </select>
                        <small class="text-muted">Vui lòng chọn khoa trước</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="saveTeacher">Lưu</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('css')

@endpush

@push('scripts')
<script>
console.log('Script loaded');
$.ajaxSetup({
    beforeSend: function(xhr) {
        console.log('Making AJAX request to:', this.url);
    },
    complete: function(xhr, status) {
        console.log('AJAX request completed:', status);
    }
});

$(document).ready(function() {
    let emailTimeout;
    
    // Function to check email
    function checkEmail(email) {
        console.log('Checking email:', email); // Debug log
        
        $.ajax({
            url: '/qlnd/check-email-giaovien',
            method: 'GET',
            data: { email: email },
            success: function(response) {
                console.log('Response:', response); // Debug log
                
                if (response.exists) {
                    $('#email-error').text('Email đã tồn tại trong hệ thống').show();
                    $('#add_email').addClass('is-invalid');
                } else {
                    $('#email-error').text('Email chưa được đăng ký trong hệ thống').show();
                    $('#add_email').addClass('is-invalid');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error); // Debug log
                $('#email-error').text('Có lỗi xảy ra khi kiểm tra email').show();
                $('#add_email').addClass('is-invalid');
            }
        });
    }

    // Check on input with debounce
    $('#add_email').on('input', function() {
        clearTimeout(emailTimeout);
        const email = $(this).val().trim();
        
        if (email) {
            emailTimeout = setTimeout(function() {
                checkEmail(email);
            }, 500); // Wait 500ms after user stops typing
        } else {
            $('#email-error').hide();
            $('#add_email').removeClass('is-invalid');
        }
    });

    // Also check on blur
    $('#add_email').on('blur', function() {
        const email = $(this).val().trim();
        if (email) {
            checkEmail(email);
        }
    });

    // Handle khoa change in modal
   
    $('#add_ma_khoa').on('change', function() {
        const khoaId = $(this).val();
        const monhocSelect = $('#add_ma_monhoc');
        
        // Reset and disable monhoc select if no khoa is selected
        if (!khoaId) {
            monhocSelect.prop('disabled', true);
            monhocSelect.html('<option value="">Vui lòng chọn khoa trước</option>');
            return;
        }
        
        // Show loading state
        monhocSelect.prop('disabled', true);
        monhocSelect.html('<option>Đang tải...</option>');

        // Get monhoc data using jQuery AJAX
        $.ajax({
            url: `/qlnd/monhoc-by-khoa/${khoaId}`,
            method: 'GET',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            success: function(data) {
                let options = '';
                
                if (data && data.length > 0) {
                    data.forEach(function(monhoc) {
                        options += `<option value="${monhoc.id_monhoc}">${monhoc.ten_monhoc} (${monhoc.so_tin_chi} tín chỉ)</option>`;
                    });
                    monhocSelect.prop('disabled', false);
                } else {
                    options = '<option value="">Không có môn học cho khoa này</option>';
                    monhocSelect.prop('disabled', true);
                }
                
                monhocSelect.html(options);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                monhocSelect.prop('disabled', true);
                monhocSelect.html('<option value="">Không thể tải danh sách môn học</option>');
            }
        });
    });

    // Handle form submission
    $('#addTeacherForm').on('submit', function(e) {
        e.preventDefault();
        console.log('Form submitted'); // Debug log
        
        const formData = new FormData(this);
        
        // Debug: Log form data
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }
        
        $.ajax({
            url: '/qlnd/giaovien/store',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                console.log('Sending request...'); // Debug log
            },
            success: function(response) {
                console.log('Success response:', response); // Debug log
                if (response.success) {
                    alert('Thêm giáo viên thành công!'); // Add notification
                    // Close modal
                    $('#addTeacherModal').modal('hide');
                    // Reset form
                    $('#addTeacherForm')[0].reset();
                    // Reload page
                    location.reload();
                } else {
                    alert(response.message || 'Có lỗi xảy ra');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error details:', {
                    status: xhr.status,
                    statusText: xhr.statusText,
                    responseText: xhr.responseText,
                    error: error
                });
                alert('Có lỗi xảy ra khi lưu giáo viên: ' + (xhr.responseJSON?.message || error));
            }
        });
    });

    // Add click handler for submit button
    $('#saveTeacher').on('click', function() {
        console.log('Save button clicked'); // Debug log
        $('#addTeacherForm').submit();
    });

    // Reset form when modal is closed
    $('#addTeacherModal').on('hidden.bs.modal', function() {
        console.log('Modal closed - resetting form'); // Debug log
        $('#addTeacherForm')[0].reset();
        $('#email-error').hide();
        $('#add_email').removeClass('is-invalid');
        $('#add_ma_monhoc').prop('disabled', true).html('<option value="">Vui lòng chọn khoa trước</option>');
    });
});
</script>

@if(request()->has('find_teacher'))
<script>
$(document).ready(function() {
    // Wait for the page to fully load
    setTimeout(function() {
        var teacherId = {{ request()->find_teacher }};
        scrollToTeacher(teacherId);
    }, 500);
});
</script>
@endif
@endpush