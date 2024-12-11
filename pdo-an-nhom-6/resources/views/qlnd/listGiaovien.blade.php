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

.select2-container {
    width: 100% !important;
}

.select2-container--bootstrap-5 .select2-selection {
    min-height: 38px;
    border: 1px solid #dee2e6;
}

.select2-container--bootstrap-5 .select2-selection--multiple {
    padding: 0.375rem 0.75rem;
}

/* Add these styles for better form layout */
.modal-body .form-group {
    margin-bottom: 1rem;
}

.select2-container {
    width: 100% !important;
}

.select2-container--bootstrap-5 .select2-selection {
    min-height: 38px;
    border: 1px solid #dee2e6;
}

.select2-container--bootstrap-5 .select2-selection--multiple {
    padding: 0.375rem 0.75rem;
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
                    <h4 class="header-title">{{ $khoa->ten_khoa }}</h4>
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
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Môn học phụ trách</label>
                                <select class="form-select" 
                                        name="ma_monhoc[]" 
                                        id="add_ma_monhoc" 
                                        multiple 
                                        required
                                        disabled>
                                    <option value="">Chọn môn học</option>
                                </select>
                                <small class="text-muted">Vui lòng chọn khoa trước</small>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="saveTeacher">Lưu</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('css')
<link href="/css/vendor/select2.min.css" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="/js/vendor/select2.min.js"></script>
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
    // When khoa is selected, enable and populate monhoc select
    $('#add_ma_khoa').on('change', function() {
        const khoaId = $(this).val();
        const monhocSelect = $('#add_ma_monhoc');
        
        console.log('Selected khoa_id:', khoaId); // Debug log
        
        if (!khoaId) {
            monhocSelect.prop('disabled', true);
            monhocSelect.html('<option value="">Chọn môn học</option>');
            return;
        }
        
        // Get monhoc for selected khoa
        $.ajax({
            url: '/qlnd/giaovien/get-monhoc', // Update URL to match route
            method: 'GET',
            data: { khoa_id: khoaId },
            beforeSend: function() {
                console.log('Sending request for khoa_id:', khoaId);
            },
            success: function(data) {
                console.log('Received data:', data); // Debug log
                
                monhocSelect.prop('disabled', false);
                let options = '<option value="">Chọn môn học</option>';
                
                // Check if data is empty
                if (Object.keys(data).length === 0) {
                    monhocSelect.html(options);
                    alert('Không tìm thấy môn học cho khoa này');
                    return;
                }
                
                // Group subjects by chuyennganh
                Object.entries(data).forEach(([chuyennganh, monhocs]) => {
                    options += `<optgroup label="${chuyennganh}">`;
                    monhocs.forEach(monhoc => {
                        options += `<option value="${monhoc.id_monhoc}">${monhoc.ten_monhoc} (${monhoc.so_tin_chi} tín chỉ)</option>`;
                    });
                    options += '</optgroup>';
                });
                
                monhocSelect.html(options);
            },
            error: function(xhr, status, error) {
                console.error('Error details:', {
                    status: status,
                    error: error,
                    response: xhr.responseText
                });
                monhocSelect.prop('disabled', true);
                alert('Có lỗi khi tải danh sách môn học: ' + error);
            }
        });
    });

    // Save teacher
    $('#saveTeacher').click(function() {
        const form = $('#addTeacherForm');
        const formData = new FormData(form[0]);

        $.ajax({
            url: '/giaovien/store',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    alert('Thêm giáo viên thành công');
                    $('#addTeacherModal').modal('hide');
                    location.reload();
                } else {
                    alert(response.error || 'Có lỗi xảy ra');
                }
            },
            error: function(xhr) {
                alert('Có lỗi xảy ra: ' + xhr.responseJSON?.error || 'Unknown error');
            }
        });
    });
});
</script>
@endpush