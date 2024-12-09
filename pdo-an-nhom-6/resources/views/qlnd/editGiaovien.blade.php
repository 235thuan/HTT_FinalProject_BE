@extends('layouts.vertical', ['title' => 'Chỉnh sửa thông tin giáo viên'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Chỉnh sửa thông tin giáo viên</h4>

                    <form action="{{ route('giaovien.update', $giaovien->id_giaovien) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ten_giaovien" class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" id="ten_giaovien" name="ten_giaovien" 
                                           value="{{ old('ten_giaovien', $giaovien->ten_giaovien) }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ma_khoa" class="form-label">Khoa</label>
                                    <select class="form-select" id="ma_khoa" name="ma_khoa" required>
                                        @foreach($khoas as $khoa)
                                            <option value="{{ $khoa->id_khoa }}" 
                                                {{ old('ma_khoa', $giaovien->ma_khoa) == $khoa->id_khoa ? 'selected' : '' }}>
                                                {{ $khoa->ten_khoa }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ old('email', $giaovien->email) }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai" 
                                           value="{{ old('so_dien_thoai', $giaovien->so_dien_thoai) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success mt-2">
                                <i class="mdi mdi-content-save"></i> Lưu thay đổi
                            </button>
                            <a href="{{ route('qlnd.listGiaovien', ['page' => session('return_page', 1)]) }}" class="btn btn-success mt-2">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 