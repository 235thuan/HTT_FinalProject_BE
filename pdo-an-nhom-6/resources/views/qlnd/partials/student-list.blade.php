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
                                                        data-lop="{{ $sv->ten_lop }}"
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sửa thông tin sinh viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editSinhVienForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id_sinhvien">

                    <div class="mb-3">
                        <label class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="edit_ten_sinhvien" name="ten_sinhvien" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                        <div id="edit_email_status"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="edit_so_dien_thoai" name="so_dien_thoai">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lớp</label>
                        <select class="form-select" id="edit_select_lop" name="id_lop" required>
                            <option value="">Chọn lớp</option>
                        </select>
                        <div class="mt-2">
                            <small class="text-muted">
                                Chuyên ngành: <span id="edit_chuyennganh_info">-</span> |
                                Năm vào học: <span id="edit_namvaohoc_info">-</span>
                            </small>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="submit" form="editSinhVienForm" class="btn btn-primary">Cập nhật</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            // Cache jQuery selectors
            const $modal = $('#editSinhVienModal');
            const $form = $('#editSinhVienForm');
            const $selectLop = $('#edit_select_lop');

            // Function to load lớp list for edit
            function loadLopListForEdit(selectedLopId, currentLopInfo) {
                try {
                    $.ajax({
                        url: '{{ route("sinhvien.getLopLists") }}',
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log('Raw response:', response);
                            if (!response || !response.success) {
                                toastr.error('Không thể tải danh sách lớp');
                                return;
                            }

                            $selectLop.empty().append('<option value="">Chọn lớp</option>');

                            response.data.data.forEach(function(lop) {
                                const option = new Option(lop.ten_lop, lop.id_lop);
                                $(option).data({
                                    'chuyennganh': lop.ten_chuyennganh,
                                    'namvaohoc': lop.nam_vao_hoc
                                });
                                $selectLop.append(option);
                            });

                            // Set selected value
                            $selectLop.val(selectedLopId);

                            // Update info with current values
                            if (currentLopInfo) {
                                $('#edit_chuyennganh_info').text(currentLopInfo.ten_chuyennganh || '-');
                                $('#edit_namvaohoc_info').text(currentLopInfo.nam_vao_hoc || '-');
                            }

                            // Trigger change to update display
                            $selectLop.trigger('change');
                        },
                        error: function(xhr) {
                            console.error('Lỗi khi tải danh sách lớp:', xhr);
                            toastr.error('Có lỗi xảy ra khi tải danh sách lớp');
                        }
                    });
                } catch (error) {
                    console.error('Lỗi:', error);
                    toastr.error('Có lỗi xảy ra');
                }
            }

            // Handle edit button click with event delegation
            $(document).on('click', '.edit-btn', function() {
                const id = $(this).data('id');
                if (!id) {
                    toastr.error('Không tìm thấy ID sinh viên');
                    return;
                }

                const $submitBtn = $form.find('button[type="submit"]');
                $submitBtn.prop('disabled', true);

                $.ajax({
                    url: '{{ route("sinhvien.edit", ["id" => ":id"]) }}'.replace(':id', id),
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (!response || !response.success || !response.data) {
                            toastr.error('Không thể tải thông tin sinh viên');
                            return;
                        }

                        const data = response.data;

                        // Set form values
                        $('#edit_id_sinhvien').val(data.id_sinhvien);
                        $('#edit_ten_sinhvien').val(data.ten_sinhvien);
                        $('#edit_email').val(data.email);
                        $('#edit_so_dien_thoai').val(data.so_dien_thoai || '');

                        // Load lớp list with current info
                        loadLopListForEdit(data.id_lop, {
                            ten_lop: data.ten_lop,
                            nam_vao_hoc: data.nam_vao_hoc,
                            ten_chuyennganh: data.ten_chuyennganh
                        });

                        $modal.modal('show');
                    },
                    error: function(xhr) {
                        console.error('Lỗi:', xhr);
                        toastr.error('Có lỗi xảy ra khi tải thông tin sinh viên');
                    },
                    complete: function() {
                        $submitBtn.prop('disabled', false);
                    }
                });
            });

            // Handle lớp change
            $selectLop.on('change', function() {
                const selectedOption = $(this).find('option:selected');
                if (!selectedOption.length) return;

                $('#edit_chuyennganh_info').text(selectedOption.data('chuyennganh') || '-');
                $('#edit_namvaohoc_info').text(selectedOption.data('namvaohoc') || '-');
            });

            // Handle form submission
            $form.on('submit', function(e) {
                e.preventDefault();
                const id = $('#edit_id_sinhvien').val();
                if (!id) {
                    toastr.error('Không tìm thấy ID sinh viên');
                    return;
                }

                const $submitBtn = $(this).find('button[type="submit"]');
                $submitBtn.prop('disabled', true);

                $.ajax({
                    url: '{{ route("sinhvien.update", ["id" => ":id"]) }}'.replace(':id', id),
                    type: 'POST',
                    data: $(this).serialize() + '&_method=PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            $modal.modal('hide');
                            toastr.success('Cập nhật sinh viên thành công!');
                            setTimeout(() => location.reload(), 1000);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON?.errors) {
                            Object.values(xhr.responseJSON.errors).forEach(error =>
                                toastr.error(error[0])
                            );
                        } else {
                            toastr.error('Có lỗi xảy ra khi cập nhật sinh viên');
                        }
                    },
                    complete: function() {
                        $submitBtn.prop('disabled', false);
                    }
                });
            });

            // Modal cleanup
            $modal.on('hidden.bs.modal', function() {
                $form.trigger('reset');
                $('#edit_chuyennganh_info').text('-');
                $('#edit_namvaohoc_info').text('-');
                $('#edit_email_status').empty();
                $form.find('.is-invalid').removeClass('is-invalid');
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            // Add search functionality
            var searchTimeout;
            $('#student-search').on('keyup', function () {
                clearTimeout(searchTimeout);
                var searchTerm = $(this).val();

                // Add a small delay to prevent too many requests
                searchTimeout = setTimeout(function () {
                    $.ajax({
                        url: '{{ route("qlnd.listSinhvien") }}',
                        data: {
                            search: searchTerm
                        },
                        success: function (response) {
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
            $('#pagination-{{ $lop->id_lop }}').on('click', '.pagination a', function (e) {
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
                    success: function (response) {
                        // Only update the specific class's content
                        var newContent = $(response).find('#student-list-{{ $lop->id_lop }}').html();
                        $('#student-list-{{ $lop->id_lop }}').html(newContent);

                        // Wait for content to be rendered
                        setTimeout(function () {
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



            // Handle column sorting
            $('.sortable').click(function () {
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
                allStudents.sort(function (a, b) {
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

                pageStudents.forEach(function (student) {
                    tbody.append(`
                <tr data-student-id="${student.id_sinhvien}">
                    <td>${student.id_sinhvien}</td>
                    <td>${student.ten_sinhvien}</td>
                    <td>${student.email}</td>
                    <td>${student.so_dien_thoai}</td>
                    <td>${student.nam_vao_hoc}</td>
                    <td>
                        <div class="btn-group">
                            <a href="/sinhvien/${student.id_sinhvien}"
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
                    success: function (response) {
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
            $(document).on('click', '.suggestion-item', function () {
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
