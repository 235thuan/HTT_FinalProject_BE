<div class="modal fade" id="discountModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cập nhật miễn giảm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="discountForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Áp dụng quy tắc miễn giảm</label>
                        <select class="form-select" name="id_mien_giam">
                            <option value="">Chọn quy tắc miễn giảm</option>
                            @foreach($mienGiamRules as $rule)
                                <option value="{{ $rule->id_mien_giam }}">
                                    {{ $rule->mo_ta }} ({{ $rule->ty_le_mien_giam }}%)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số tiền miễn giảm</label>
                        <input type="number" class="form-control" name="so_tien" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lý do miễn giảm</label>
                        <textarea class="form-control" name="ly_do" rows="3"></textarea>
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

