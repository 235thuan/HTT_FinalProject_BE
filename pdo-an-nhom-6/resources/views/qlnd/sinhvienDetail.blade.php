@extends('layouts.vertical', ['title' => 'Chi tiết sinh viên'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="mdi mdi-arrow-left"></i> Quay lại
                    </a>
                </div>
                <h4 class="page-title">Chi tiết sinh viên</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Họ và tên</label>
                                <p class="form-control-static">{{ $sinhvien->ten_sinhvien }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Lớp</label>
                                <p class="form-control-static">{{ $sinhvien->lop }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <p class="form-control-static">{{ $sinhvien->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Số điện thoại</label>
                                <p class="form-control-static">{{ $sinhvien->so_dien_thoai }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Năm vào học</label>
                                <p class="form-control-static">{{ $sinhvien->nam_vao_hoc }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Chuyên ngành</label>
                                <p class="form-control-static">{{ $sinhvien->ten_chuyennganh }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Khoa</label>
                                <p class="form-control-static">{{ $sinhvien->ten_khoa }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 