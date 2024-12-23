<style>
.sortable {
    cursor: pointer;
    user-select: none;
}
.sortable i {
    font-size: 14px;
    margin-left: 5px;
    opacity: 0.5;
    transition: all 0.2s;
}
.sortable:hover i {
    opacity: 1;
}
.sortable i.mdi-sort-ascending,
.sortable i.mdi-sort-descending {
    opacity: 1;
    color: #727cf5;
}
</style>

@foreach($lops as $lop)
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <span>Danh sách lớp</span> {{ $lop->ten_lop }}
                    <span class="badge bg-primary ms-2">
                        {{ $lop->total_students }} sinh viên
                    </span>
                    <div>
                        {{ $lop->ten_chuyennganh }} - {{ $lop->ten_khoa }}
                    </div>
                </h5>
            </div>
            <div class="card-body" id="student-list-{{ $lop->id_lop }}" 
                 data-all-students='@json($lop->all_students)'>
                @if($lop->sinhviens->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="sortable" data-sort="id_sinhvien">
                                        ID <i class="mdi mdi-sort"></i>
                                    </th>
                                    <th class="sortable" data-sort="ten_sinhvien">
                                        Họ và tên <i class="mdi mdi-sort"></i>
                                    </th>
                                    <th class="sortable" data-sort="email">
                                        Email <i class="mdi mdi-sort"></i>
                                    </th>
                                    <th class="sortable" data-sort="so_dien_thoai">
                                        Số điện thoại <i class="mdi mdi-sort"></i>
                                    </th>
                                    <th class="sortable" data-sort="nam_vao_hoc">
                                        Năm vào học <i class="mdi mdi-sort"></i>
                                    </th>
                                    <th style="width: 125px;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lop->sinhviens as $sv)
                                <tr data-student-id="{{ $sv->id_sinhvien }}">
                                    <td>{{ $sv->id_sinhvien }}</td>
                                    <td>{{ $sv->ten_sinhvien }}</td>
                                    <td>{{ $sv->email }}</td>
                                    <td>{{ $sv->so_dien_thoai }}</td>
                                    <td>{{ $sv->nam_vao_hoc }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('qlnd.sinhvien.detail', $sv->id_sinhvien) }}" 
                                               class="btn btn-soft-primary btn-sm" 
                                               title="Xem chi tiết">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-soft-info btn-sm edit-btn" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editSinhVienModal"
                                                    data-id="{{ $sv->id_sinhvien }}"
                                                    data-name="{{ $sv->ten_sinhvien }}"
                                                    data-email="{{ $sv->email }}"
                                                    data-phone="{{ $sv->so_dien_thoai }}"
                                                    data-lop="{{ $sv->lop }}"
                                                    data-nam="{{ $sv->nam_vao_hoc }}"
                                                    title="Chỉnh sửa">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-3" id="pagination-{{ $lop->id_lop }}">
                            {{ $lop->sinhviens->links('vendor.pagination.bootstrap-5', ['pageName' => 'page_'.$lop->id_lop]) }}
                        </div>
                    </div>
                @else
                    <div class="text-center p-4">
                        <p class="text-muted">Không có sinh viên nào trong lớp này</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Edit Modal -->
<div class="modal fade" id="editSinhVienModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh sửa thông tin sinh viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editSinhVienForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" id="edit_id" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" name="ten_sinhvien" id="edit_ten_sinhvien" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Lớp</label>
                                <select class="form-select" name="lop" id="edit_lop" required>
                                    @foreach($allLops as $l)
                                        <option value="{{ $l->ten_lop }}">{{ $l->ten_lop }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="edit_email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" name="so_dien_thoai" id="edit_so_dien_thoai" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Năm vào học</label>
                                <input type="number" class="form-control" name="nam_vao_hoc" id="edit_nam_vao_hoc" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Add search functionality
    var searchTimeout;
    $('#student-search').on('keyup', function() {
        clearTimeout(searchTimeout);
        var searchTerm = $(this).val();
        
        // Add a small delay to prevent too many requests
        searchTimeout = setTimeout(function() {
            $.ajax({
                url: '{{ route("qlnd.listSinhvien") }}',
                data: { 
                    search: searchTerm
                },
                success: function(response) {
                    // Update the content while maintaining scroll position
                    var scrollPosition = $(window).scrollTop();
                    $('#student-lists').html(response);
                    $(window).scrollTop(scrollPosition);
                }
            });
        }, 300);
    });

    // Handle pagination for each class
    @foreach($lops as $lop)
    $('#pagination-{{ $lop->id_lop }}').on('click', '.pagination a', function(e) {
        e.preventDefault();
        
        // Get the clicked pagination element
        var paginationElement = $(this);
        var card = paginationElement.closest('.card');
        
        // Store the current viewport offset of the card
        var cardOffset = card.offset().top - $(window).scrollTop();
        
        var url = $(this).attr('href');
        
        // Extract current page from URL
        var currentPage = url.match(/page_{{ $lop->id_lop }}=(\d+)/);
        currentPage = currentPage ? currentPage[1] : 1;
        
        $.ajax({
            url: url,
            data: {
                'page_{{ $lop->id_lop }}': currentPage,
                'search_lop': '{{ request()->get("search_lop") }}'
            },
            success: function(response) {
                // Only update the specific class's content
                var newContent = $(response).find('#student-list-{{ $lop->id_lop }}').html();
                $('#student-list-{{ $lop->id_lop }}').html(newContent);
                
                // Wait for content to be rendered
                setTimeout(function() {
                    // Get the updated card position and maintain viewport offset
                    var newPosition = card.offset().top - cardOffset;
                    
                    // Smooth scroll to the position
                    $('html, body').animate({
                        scrollTop: newPosition
                    }, 0);
                }, 100);
                
                // Update URL without page reload
                window.history.pushState({}, '', url);
            }
        });
    });
    @endforeach

    // Handle modal show event
    $('#editSinhVienModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        
        // Get data from button data attributes
        var id = button.data('id');
        var name = button.data('name');
        var email = button.data('email');
        var phone = button.data('phone');
        var lop = button.data('lop');
        var nam = button.data('nam');
        
        console.log('Modal data:', {
            id: id,
            name: name,
            email: email,
            phone: phone,
            lop: lop,
            nam: nam
        });

        // Set form values
        $('#edit_id').val(id);
        $('#edit_ten_sinhvien').val(name);
        $('#edit_email').val(email);
        $('#edit_so_dien_thoai').val(phone);
        $('#edit_lop').val(lop);
        $('#edit_nam_vao_hoc').val(nam);
    });

    // Handle form submit
    $('#editSinhVienForm').on('submit', function(e) {
        e.preventDefault();
        
        var id = $('#edit_id').val();
        var formData = new FormData(this);

        $.ajax({
            url: '/sinhvien/' + id,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function(response) {
                console.log('Success response:', response);
                
                if (response.success) {
                    // Find the button that was clicked
                    var editButton = $('button[data-id="' + id + '"]');
                    var row = editButton.closest('tr');

                    // Update the row data
                    row.find('td:eq(1)').text($('#edit_ten_sinhvien').val());
                    row.find('td:eq(2)').text($('#edit_email').val());
                    row.find('td:eq(3)').text($('#edit_so_dien_thoai').val());
                    row.find('td:eq(4)').text($('#edit_nam_vao_hoc').val());

                    // Update the button's data attributes
                    editButton.attr('data-name', $('#edit_ten_sinhvien').val());
                    editButton.attr('data-email', $('#edit_email').val());
                    editButton.attr('data-phone', $('#edit_so_dien_thoai').val());
                    editButton.attr('data-lop', $('#edit_lop').val());
                    editButton.attr('data-nam', $('#edit_nam_vao_hoc').val());

                    // Close modal using Bootstrap's modal method
                    var modal = bootstrap.Modal.getInstance(document.getElementById('editSinhVienModal'));
                    $('.modal-backdrop').remove();
                    modal.hide();
                    
                    // Optional: Reset form
                    $('#editSinhVienForm')[0].reset();
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr);
                var errorMessage = xhr.responseJSON ? xhr.responseJSON.error : 'Có lỗi xảy ra';
                alert(errorMessage);
            }
        });
    });

    // Handle column sorting
    $('.sortable').click(function() {
        var column = $(this);
        var sort = column.data('sort');
        var card = column.closest('.card');
        var cardBody = card.find('.card-body');
        var lopId = cardBody.attr('id').replace('student-list-', '');
        var icon = column.find('i');
        
        // Get all students for this class
        var allStudents = JSON.parse(cardBody.attr('data-all-students'));
        
        // Toggle sort direction
        var isAsc = icon.hasClass('mdi-sort') || icon.hasClass('mdi-sort-descending');
        
        // Reset all icons in this table
        column.closest('table').find('.sortable i')
            .removeClass('mdi-sort-ascending mdi-sort-descending')
            .addClass('mdi-sort');
        
        // Update clicked column icon
        icon.removeClass('mdi-sort')
            .addClass(isAsc ? 'mdi-sort-ascending' : 'mdi-sort-descending');
        
        // Sort all students
        allStudents.sort(function(a, b) {
            var aValue = a[sort];
            var bValue = b[sort];
            
            // Handle numeric sorting
            if (sort === 'id_sinhvien' || sort === 'nam_vao_hoc') {
                aValue = parseInt(aValue) || 0;
                bValue = parseInt(bValue) || 0;
            }
            
            if (isAsc) {
                return aValue > bValue ? 1 : aValue < bValue ? -1 : 0;
            } else {
                return aValue < bValue ? 1 : aValue > bValue ? -1 : 0;
            }
        });
        
        // Get current page
        var currentPage = parseInt(new URLSearchParams(window.location.search)
            .get('page_' + lopId)) || 1;
        
        // Calculate pagination
        var perPage = 5;
        var start = (currentPage - 1) * perPage;
        var pageStudents = allStudents.slice(start, start + perPage);
        
        // Update table body
        var tbody = card.find('tbody');
        tbody.empty();
        
        pageStudents.forEach(function(student) {
            tbody.append(`
                <tr data-student-id="${student.id_sinhvien}">
                    <td>${student.id_sinhvien}</td>
                    <td>${student.ten_sinhvien}</td>
                    <td>${student.email}</td>
                    <td>${student.so_dien_thoai}</td>
                    <td>${student.nam_vao_hoc}</td>
                    <td>
                        <div class="btn-group">
                            <a href="/qlnd/sinhvien/${student.id_sinhvien}" 
                               class="btn btn-soft-primary btn-sm" 
                               title="Xem chi tiết">
                                <i class="mdi mdi-eye"></i>
                            </a>
                            <button type="button" 
                                    class="btn btn-soft-info btn-sm edit-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editSinhVienModal"
                                    data-id="${student.id_sinhvien}"
                                    data-name="${student.ten_sinhvien}"
                                    data-email="${student.email}"
                                    data-phone="${student.so_dien_thoai}"
                                    data-lop="${student.lop}"
                                    data-nam="${student.nam_vao_hoc}"
                                    title="Chỉnh sửa">
                                <i class="mdi mdi-pencil"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `);
        });
    });

    function scrollToStudent(id, lop, page) {
        var lopCard = $(`.card-title:contains("${lop}")`).closest('.card');
        var lopId = lopCard.find('.card-body').attr('id').replace('student-list-', '');
        
        // Load the correct page first
        var url = new URL(window.location.href);
        url.searchParams.set(`page_${lopId}`, page);
        
        $.ajax({
            url: url.toString(),
            success: function(response) {
                // Update content
                $('#student-lists').html(response);
                
                // Update URL
                window.history.pushState({}, '', url.toString());
                
                // Find and scroll to student
                var studentRow = $(`tr[data-student-id="${id}"]`);
                if (studentRow.length) {
                    $('html, body').animate({
                        scrollTop: studentRow.offset().top - 100
                    }, 500);
                    studentRow.addClass('highlight-row');
                    setTimeout(() => studentRow.removeClass('highlight-row'), 3000);
                }
            }
        });
    }

    // Update suggestion click handler
    $(document).on('click', '.suggestion-item', function() {
        var type = $(this).data('type');
        if (type === 'student') {
            var id = $(this).data('id');
            var lop = $(this).data('lop');
            var page = $(this).data('page');
            scrollToStudent(id, lop, page);
        } else {
            var lop = $(this).data('lop');
            scrollToClass(lop);
        }
        $('#student-search-suggestions').hide();
    });
});
</script>
@endpush