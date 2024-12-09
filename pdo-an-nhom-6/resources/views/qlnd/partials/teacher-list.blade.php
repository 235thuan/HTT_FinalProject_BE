@foreach($khoas as $khoa)
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                     {{ $khoa->ten_khoa }}
                    <span class="badge bg-primary ms-2">
                        {{ $khoa->giaoviens->total() }} giáo viên
                    </span>
                </h5>
            </div>
            <div class="card-body">
                @if($khoa->giaoviens->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th style="width: 125px;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($khoa->giaoviens as $gv)
                                <tr>
                                    <td>{{ $gv->id_giaovien }}</td>
                                    <td>{{ $gv->ten_giaovien }}</td>
                                    <td>{{ $gv->email }}</td>
                                    <td>{{ $gv->so_dien_thoai }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('qlnd.giaovien.detail', $gv->id_giaovien) }}" 
                                               class="btn btn-soft-primary btn-sm" 
                                               title="Xem chi tiết">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-soft-info btn-sm edit-btn" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editGiaoVienModal"
                                                    data-id="{{ $gv->id_giaovien }}"
                                                    data-name="{{ $gv->ten_giaovien }}"
                                                    data-email="{{ $gv->email }}"
                                                    data-phone="{{ $gv->so_dien_thoai }}"
                                                    data-khoa="{{ $gv->ma_khoa }}"
                                                    data-khoa-name="{{ $khoa->ten_khoa }}"
                                                    title="Chỉnh sửa">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $khoa->giaoviens->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                @else
                    <div class="text-center p-4">
                        <p class="text-muted">Không có giáo viên nào trong khoa này</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Edit Modal -->
<div class="modal fade" id="editGiaoVienModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh sửa thông tin giáo viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editGiaoVienForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" id="edit_id" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" name="ten_giaovien" id="edit_ten_giaovien" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Khoa</label>
                                <select class="form-select" name="ma_khoa" id="edit_ma_khoa" required>
                                    @foreach($khoas as $k)
                                        <option value="{{ $k->id_khoa }}">{{ $k->ten_khoa }}</option>
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
    // Handle modal show event
    $('#editGiaoVienModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        
        // Get data from button data attributes
        var id = button.data('id');
        var name = button.data('name');
        var email = button.data('email');
        var phone = button.data('phone');
        var khoa = button.data('khoa');
        var khoaName = button.data('khoa-name');
        
        console.log('Modal data:', {
            id: id,
            name: name,
            email: email,
            phone: phone,
            khoa: khoa,
            khoaName: khoaName
        });

        // Set form values
        $('#edit_id').val(id);
        $('#edit_ten_giaovien').val(name);
        $('#edit_email').val(email);
        $('#edit_so_dien_thoai').val(phone);
        $('#edit_ma_khoa').val(khoa);

        // Pre-select the khoa in dropdown
        $('#edit_ma_khoa option').each(function() {
            if ($(this).text() === khoaName) {
                $(this).prop('selected', true);
            }
        });
    });

    // Handle form submit
    $('#editGiaoVienForm').on('submit', function(e) {
        e.preventDefault();
        
        var id = $('#edit_id').val();
        var formData = new FormData(this);

        $.ajax({
            url: '/giaovien/' + id,
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
                    row.find('td:eq(1)').text($('#edit_ten_giaovien').val());
                    row.find('td:eq(2)').text($('#edit_email').val());
                    row.find('td:eq(3)').text($('#edit_so_dien_thoai').val());

                    // Update the button's data attributes
                    editButton.attr('data-name', $('#edit_ten_giaovien').val());
                    editButton.attr('data-email', $('#edit_email').val());
                    editButton.attr('data-phone', $('#edit_so_dien_thoai').val());
                    editButton.attr('data-khoa', $('#edit_ma_khoa').val());

                    // Close modal using Bootstrap's modal method
                    var modal = bootstrap.Modal.getInstance(document.getElementById('editGiaoVienModal'));
                    modal.hide();

                    
                    // Optional: Reset form
                    $('#editGiaoVienForm')[0].reset();
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr);
                var errorMessage = xhr.responseJSON ? xhr.responseJSON.error : 'Có lỗi xảy ra';
                alert(errorMessage);
            }
        });
    });
});
</script>
@endpush
