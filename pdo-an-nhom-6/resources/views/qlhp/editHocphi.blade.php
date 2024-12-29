@extends('layouts.vertical', ['title' => 'Sửa học phí'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Thông tin sinh viên -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Thông tin sinh viên</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered table-centered">
                                    <tr>
                                        <th width="35%">Tên sinh viên:</th>
                                        <td>{{ $hocphi['sinh_vien']['ten'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td>{{ $hocphi['sinh_vien']['email'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Số điện thoại:</th>
                                        <td>{{ $hocphi['sinh_vien']['so_dien_thoai'] }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered table-centered">
                                    <tr>
                                        <th width="35%">Lớp:</th>
                                        <td>{{ $hocphi['sinh_vien']['lop'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Chuyên ngành:</th>
                                        <td>{{ $hocphi['sinh_vien']['chuyen_nganh'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Trạng thái:</th>
                                        <td>{{ $hocphi['trang_thai'] }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tổng quan học phí -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Tổng quan học phí</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card border-primary border">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">Tổng tiền</h5>
                                        <h3 class="mb-0">{{ number_format($hocphi['tong_tien'], 0, ',', '.') }} đ</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-success border">
                                    <div class="card-body">
                                        <h5 class="card-title text-success">Miễn giảm</h5>
                                        <h3 class="mb-0">{{ number_format($hocphi['tong_mien_giam'], 0, ',', '.') }}
                                            đ</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-info border">
                                    <div class="card-body">
                                        <h5 class="card-title text-info">Phải đóng</h5>
                                        <h3 class="mb-0">{{ number_format($hocphi['tong_phai_dong'], 0, ',', '.') }}
                                            đ</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chi tiết học phí -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Chi tiết học phí</h4>
                    </div>
                    <div class="card-body">
                        <form id="editHocPhiForm" action="{{ route('hocphi.update', $hocphi['id_hocphi']) }}"
                              method="POST">
                            @csrf
                            @method('PUT')
                            <div class="table-responsive">
                                <table class="table table-centered table-bordered mb-0">
                                    <thead>
                                    <tr>
                                        <th>Môn học</th>
                                        <th>Số tín chỉ</th>
                                        <th>Khoản phí</th>
                                        <th class="text-end">Số tiền</th>
                                        <th>Miễn giảm</th>
                                        <th class="text-end">Thành tiền</th>
                                    </tr>
                                    </thead>
                                    <!-- In the table body section -->
                                    <tbody>
                                    @foreach($hocphi['chi_tiet'] as $index => $ct)
                                        <tr>
                                            <!-- Hidden input for id_chitiethocphi -->
                                            <input type="hidden" name="chi_tiet[{{$index}}][id_chitiethocphi]" value="{{ $ct['id'] }}">

                                            <td>{{ $ct['mon_hoc']['ten'] ?? 'N/A' }}</td>
                                            <td>{{ $ct['mon_hoc']['so_tin_chi'] ?? 'N/A' }}</td>
                                            <td>{{ $ct['ten_khoan_phi'] }}</td>
                                            <td class="text-end">{{ number_format($ct['so_tien'], 0, ',', '.') }} đ</td>
                                            <td>
                                                @if(isset($ct['mon_hoc']['id']))
                                                    <!-- Current miễn giảm info if exists -->
                                                    @if(!empty($ct['mien_giam']['id']))
                                                        <div class="mb-2">
                                                            -{{ number_format($ct['mien_giam']['tien_mien_giam'], 0, ',', '.') }} đ
                                                            ({{ $ct['mien_giam']['ty_le'] }}%)
                                                            {{ $ct['mien_giam']['mo_ta'] }}
                                                        </div>
                                                    @endif

                                                    <!-- Hidden input for id_monhoc -->
                                                    <input type="hidden" name="chi_tiet[{{$index}}][id_monhoc]" value="{{ $ct['mon_hoc']['id'] }}">

                                                    <!-- Miễn giảm selection -->
                                                    <select class="form-control mien-giam-select"
                                                            name="chi_tiet[{{$index}}][id_mien_giam]"
                                                            data-monhoc="{{ $ct['mon_hoc']['id'] }}"
                                                            data-chitiethocphi="{{ $ct['id'] }}"
                                                            data-sotien="{{ $ct['so_tien'] }}">
                                                        <option value="">Không miễn giảm</option>
                                                        @foreach($mienGiamList as $mg)
                                                            @if($mg['id_monhoc'] == $ct['mon_hoc']['id'])
                                                                <option value="{{ $mg['id_mien_giam'] }}"
                                                                        {{ ($ct['mien_giam']['id'] ?? '') == $mg['id_mien_giam'] ? 'selected' : '' }}
                                                                        data-tyle="{{ $mg['ty_le_mien_giam'] }}"
                                                                        data-sotiencodinh="{{ $mg['so_tien_mien_giam'] }}">
                                                                    {{ $mg['mo_ta'] }}
                                                                    ({{ $mg['ty_le_mien_giam'] }}%
                                                                    @if($mg['so_tien_mien_giam'])
                                                                        + {{ number_format($mg['so_tien_mien_giam'], 0, ',', '.') }}đ
                                                                    @endif
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>

                                                    <!-- Update button -->
                                                    <button type="button" class="btn btn-sm btn-primary mt-2 update-mien-giam">
                                                        Cập nhật
                                                    </button>
                                                @else
                                                    <span class="text-muted">Không áp dụng</span>
                                                @endif
                                            </td>
                                            <td class="text-end thanh-tien">
                                                {{ number_format($ct['thanh_tien'], 0, ',', '.') }} đ
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-end mt-3">
                                <a href="{{ route('hocphi.detail', $hocphi['id_hocphi']) }}"
                                   class="btn btn-secondary me-1">Quay lại</a>
                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Rest of the file remains the same until script section --}}

@push('scripts')
    <script>
        $(document).ready(function() {
            // Handle update button click
            $('.update-mien-giam').click(function() {
                var row = $(this).closest('tr');
                var select = row.find('.mien-giam-select');
                var idHocPhi = '{{ $hocphi["id_hocphi"] }}'; // Add this line
                var idChiTietHocPhi = select.data('chitiethocphi');
                var idMonHoc = select.data('monhoc');
                var idMienGiam = select.val();
                var soTien = select.data('sotien');

                $.ajax({
                    url: '{{ route("hocphi.updateMienGiam") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id_hocphi: idHocPhi, // Add this line
                        id_chitiethocphi: idChiTietHocPhi,
                        id_monhoc: idMonHoc,
                        id_mien_giam: idMienGiam
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update thành tiền
                            var selectedOption = select.find('option:selected');
                            var tyLe = parseFloat(selectedOption.data('tyle')) || 0;
                            var soTienCoDinh = parseFloat(selectedOption.data('sotiencodinh')) || 0;

                            var tienMienGiam = 0;
                            if (idMienGiam) {
                                tienMienGiam = (soTien * tyLe / 100) + soTienCoDinh;
                            }

                            var thanhTien = soTien - tienMienGiam;
                            row.find('.thanh-tien').text(new Intl.NumberFormat('vi-VN').format(thanhTien) + ' đ');

                            // Update tổng quan học phí
                            if (response.data) {
                                updateTongQuan(response.data);
                            }

                            toastr.success('Cập nhật miễn giảm thành công');
                        } else {
                            toastr.error(response.message || 'Có lỗi xảy ra');
                        }
                    },
                    error: function(xhr) {
                        var message = 'Có lỗi xảy ra khi cập nhật';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        toastr.error(message);
                    }
                });
            });

            // Pre-calculate thành tiền when selecting miễn giảm (optional)
            $('.mien-giam-select').change(function() {
                var select = $(this);
                var row = select.closest('tr');
                var soTien = parseFloat(select.data('sotien'));
                var selectedOption = select.find('option:selected');
                var tyLe = parseFloat(selectedOption.data('tyle')) || 0;
                var soTienCoDinh = parseFloat(selectedOption.data('sotiencodinh')) || 0;

                var tienMienGiam = 0;
                if (select.val()) {
                    tienMienGiam = (soTien * tyLe / 100) + soTienCoDinh;
                }

                var thanhTien = soTien - tienMienGiam;
                row.find('.thanh-tien').text(new Intl.NumberFormat('vi-VN').format(thanhTien) + ' đ');
            });

            // Function to update tổng quan
            function updateTongQuan(data) {
                if (data) {
                    $('.card-title:contains("Tổng tiền")').siblings('h3').text(
                        new Intl.NumberFormat('vi-VN').format(data.tong_tien) + ' đ'
                    );
                    $('.card-title:contains("Miễn giảm")').siblings('h3').text(
                        new Intl.NumberFormat('vi-VN').format(data.tong_mien_giam) + ' đ'
                    );
                    $('.card-title:contains("Phải đóng")').siblings('h3').text(
                        new Intl.NumberFormat('vi-VN').format(data.tong_phai_dong) + ' đ'
                    );
                }
            }
        });
    </script>
@endpush
