@extends('layouts.vertical', ['title' => 'Chỉnh sửa thông tin sinh viên'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Chỉnh sửa thông tin sinh viên</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('sinhvien.update', $sinhvien->id_sinhvien) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" name="ten_sinhvien" 
                                   value="{{ old('ten_sinhvien', $sinhvien->ten_sinhvien) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Lớp</label>
                            <select class="form-control" name="lop">
                                @foreach($lops as $lop)
                                    <option value="{{ $lop->ten_lop }}" 
                                        {{ $sinhvien->lop == $lop->ten_lop ? 'selected' : '' }}>
                                        {{ $lop->ten_lop }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Năm vào học</label>
                            <input type="number" class="form-control" name="nam_vao_hoc" 
                                   value="{{ old('nam_vao_hoc', $sinhvien->nam_vao_hoc) }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{ route('qlnd.listSinhvien', ['page' => session('return_page', 1)]) }}" class="btn btn-secondary">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 