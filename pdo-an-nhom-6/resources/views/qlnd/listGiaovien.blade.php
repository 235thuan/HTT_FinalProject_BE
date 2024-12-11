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
                data-bs-target="#addGiaoVienModal"
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
<div class="modal fade" id="addGiaoVienModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm giáo viên mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addGiaoVienForm">
                @csrf
                <input type="hidden" name="ma_khoa" id="add_ma_khoa">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" name="ten_giaovien" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                                <div class="invalid-feedback">Email đã được đăng ký</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" name="so_dien_thoai" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Chuyên ngành</label>
                                <select class="form-select" name="ma_chuyennganh" id="add_ma_chuyennganh" required>
                                    <option value="">Chọn chuyên ngành</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
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
                                <small class="text-muted">Vui lòng chọn chuyên ngành trước</small>
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
    // Email validation
    let emailTimeout;
    $('#email').on('keyup', function() {
        clearTimeout(emailTimeout);
        let email = $(this).val();
        let emailInput = $(this);
        
        emailTimeout = setTimeout(function() {
            $.ajax({
                url: '{{ route("qlnd.checkEmailGiaovien") }}',
                data: { email: email },
                success: function(response) {
                    if (response.exists) {
                        emailInput.addClass('is-invalid');
                        emailInput.removeClass('is-valid');
                    } else {
                        emailInput.removeClass('is-invalid');
                        emailInput.addClass('is-valid');
                    }
                }
            });
        }, 500);
    });

    // Initialize Select2 for monhoc select
    $('#add_ma_monhoc').select2({
        theme: 'bootstrap-5',
        width: '100%',
        dropdownParent: $('#addGiaoVienModal'),
        placeholder: "Chọn môn học phụ trách"
    });

    // Load chuyennganh when modal opens
    $('#addGiaoVienModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var khoaId = button.data('khoa');
        $('#add_ma_khoa').val(khoaId);
        
        // Reset form
        $('#addGiaoVienForm')[0].reset();
        $('#add_ma_monhoc').prop('disabled', true).empty().trigger('change');
        
        // Load chuyennganh
        $.ajax({
            url: '{{ route("qlnd.getChuyenNganh") }}',
            method: 'GET',
            data: { khoa_id: khoaId },
            success: function(response) {
                var select = $('#add_ma_chuyennganh');
                select.empty();
                select.append('<option value="">Chọn chuyên ngành</option>');
                response.forEach(function(item) {
                    select.append(`<option value="${item.id_chuyennganh}">${item.ten_chuyennganh}</option>`);
                });
            },
            error: function(xhr) {
                console.error('Error loading chuyennganh:', xhr);
                toastr.error('Không thể tải danh sách chuyên ngành');
            }
        });
    });

    // Load monhoc when chuyennganh changes
    $('#add_ma_chuyennganh').on('change', function() {
        var chuyenNganhId = $(this).val();
        var monhocSelect = $('#add_ma_monhoc');
        
        if (!chuyenNganhId) {
            monhocSelect.prop('disabled', true)
                       .empty()
                       .trigger('change');
            return;
        }
        
        monhocSelect.prop('disabled', false);
        
        $.ajax({
            url: '{{ route("qlnd.getMonHoc") }}',
            method: 'GET',
            data: { chuyennganh_id: chuyenNganhId },
            success: function(response) {
                monhocSelect.empty();
                response.forEach(function(item) {
                    monhocSelect.append(`<option value="${item.id_monhoc}">${item.ten_monhoc}</option>`);
                });
                monhocSelect.trigger('change');
            },
            error: function(xhr) {
                console.error('Error loading monhoc:', xhr);
                toastr.error('Không thể tải danh sách môn học');
                monhocSelect.prop('disabled', true);
            }
        });
    });

    // Handle form submit
    $('#addGiaoVienForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: '{{ route("qlnd.giaovien.store") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    toastr.success('Thêm giáo viên thành công');
                    location.reload();
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    Object.keys(errors).forEach(function(key) {
                        toastr.error(errors[key][0]);
                    });
                } else {
                    toastr.error('Có lỗi xảy ra khi thêm giáo viên');
                }
            }
        });
    });

    // Add search functionality
    var searchTimeout;
    var currentSearchTerm = '';
    
    $('#teacher-search').on('keyup', function(e) {
        var searchBox = $(this);
        var suggestionsBox = $('#teacher-search-suggestions');
        var searchTerm = searchBox.val().trim();
        currentSearchTerm = searchTerm;
        
        clearTimeout(searchTimeout);
        
        if (searchTerm.length < 2) {
            suggestionsBox.hide();
            return;
        }
        
        // Handle enter key
        if (e.key === 'Enter') {
            performTeacherSearch(searchTerm);
            return;
        }
        
        // Get suggestions
        searchTimeout = setTimeout(function() {
            $.ajax({
                url: '{{ route("qlnd.searchGiaovien") }}',
                data: { 
                    search: searchTerm,
                    suggest: true
                },
                success: function(response) {
                    var suggestionsList = suggestionsBox.find('.suggestions-list');
                    suggestionsList.empty();
                    
                    if (response.suggestions && response.suggestions.length > 0) {
                        response.suggestions.forEach(function(item) {
                            var html = '';
                            if (item.type === 'department') {
                                html = `
                                    <div class="suggestion-item" data-type="department" data-khoa="${item.ma_khoa}">
                                        <div class="d-flex justify-content-between">
                                            <span>${highlightMatch(item.ten_khoa, searchTerm)}</span>
                                            <small class="text-muted">${item.teacher_count} giáo viên</small>
                                        </div>
                                    </div>
                                `;
                            } else {
                                html = `
                                    <div class="suggestion-item" data-type="teacher" data-id="${item.id_giaovien}">
                                        <div class="d-flex justify-content-between">
                                            <span>${highlightMatch(item.ten_giaovien, searchTerm)}</span>
                                            <small class="text-muted">${item.ten_khoa}</small>
                                        </div>
                                        <small class="text-muted">${item.email}</small>
                                    </div>
                                `;
                            }
                            suggestionsList.append(html);
                        });
                        
                        suggestionsBox.find('.suggestions-list').show();
                        suggestionsBox.find('.no-results').hide();
                    } else {
                        suggestionsBox.find('.suggestions-list').hide();
                        suggestionsBox.find('.no-results').show();
                    }
                    
                    suggestionsBox.show();
                }
            });
        }, 300);
    });

    // Handle suggestion click
    $(document).on('click', '.suggestion-item', function() {
        var type = $(this).data('type');
        if (type === 'teacher') {
            var id = $(this).data('id');
            scrollToTeacher(id);
        } else {
            var khoa = $(this).data('khoa');
            filterByDepartment(khoa);
        }
        $('#teacher-search-suggestions').hide();
    });

    function scrollToTeacher(id) {
        var teacherRow = $(`tr[data-id="${id}"]`);
        if (teacherRow.length) {
            $('html, body').animate({
                scrollTop: teacherRow.offset().top - 100
            }, 500);
            teacherRow.addClass('highlight-row');
            setTimeout(() => teacherRow.removeClass('highlight-row'), 3000);
        }
    }

    function filterByDepartment(khoaId) {
        window.location.href = window.location.pathname + '?khoa=' + khoaId;
    }

    function highlightMatch(text, term) {
        if (!term) return text;
        var regex = new RegExp(`(${term})`, 'gi');
        return text.replace(regex, '<span class="highlight">$1</span>');
    }
});
</script>
@endpush