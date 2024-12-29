@extends('layouts.vertical', ['title' => 'Chi tiết người dùng'])

@section('css')
<link href="/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card text-center">
                <div class="card-body">
                    <img src="/assets/images/users/avatar-1.jpg" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                    <h4 class="mb-0 mt-2">{{ isset($sinhvien) ? $sinhvien->ten_sinhvien : $giaovien->ten_giaovien }}</h4>
                    <p class="text-muted font-14">{{ isset($sinhvien) ? 'Sinh viên' : 'Giáo viên' }}</p>

                    <div class="text-start mt-3">
                        <h4 class="font-13 text-uppercase">Thông tin cơ bản:</h4>

                        @if(isset($sinhvien))
                            <p class="text-muted mb-2 font-13"><strong>Mã sinh viên:</strong> <span class="ms-2">{{ $sinhvien->id_sinhvien }}</span></p>
                            <p class="text-muted mb-2 font-13"><strong>Lớp:</strong> <span class="ms-2">{{ $sinhvien->ten_lop }}</span></p>
                            <p class="text-muted mb-2 font-13"><strong>Năm vào học:</strong> <span class="ms-2">{{ $sinhvien->nam_vao_hoc }}</span></p>
                        @else
                            <p class="text-muted mb-2 font-13"><strong>Mã giáo viên:</strong> <span class="ms-2">{{ $giaovien->id_giaovien }}</span></p>
                            <p class="text-muted mb-2 font-13"><strong>Khoa:</strong> <span class="ms-2">{{ $giaovien->ten_khoa }}</span></p>
                        @endif

                        <p class="text-muted mb-2 font-13"><strong>Số điện thoại:</strong><span class="ms-2">{{ isset($sinhvien) ? $sinhvien->so_dien_thoai : $giaovien->so_dien_thoai }}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>Email:</strong> <span class="ms-2">{{ isset($sinhvien) ? $sinhvien->email : $giaovien->email }}</span></p>
                    </div>

                    <!-- Keep template structure for future data -->
                    <div class="text-start mt-3">
                        <h4 class="font-13 text-uppercase">About Me:</h4>
                        <p class="text-muted mb-2 font-13">
                            <em>Chưa có thông tin</em>
                        </p>
                    </div>

                    <ul class="social-list list-inline mt-3 mb-0">
                        <li class="list-inline-item">
                            <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Template sections for future data -->
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Skills</h4>
                    <p class="text-muted">Chưa có thông tin</p>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                        <li class="nav-item">
                            <a href="#aboutme" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                                Thông tin chi tiết
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#timeline" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                Hoạt động
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="aboutme">
                            <!-- Template sections for future data -->
                            <h5 class="text-uppercase"><i class="mdi mdi-briefcase me-1"></i>
                                Experience</h5>
                            <p class="text-muted">Chưa có thông tin</p>

                            <h5 class="text-uppercase mt-4"><i class="mdi mdi-book-open-page-variant me-1"></i>
                                Projects</h5>
                            <p class="text-muted">Chưa có thông tin</p>

                            <h5 class="text-uppercase mt-4"><i class="mdi mdi-graduation-cap me-1"></i>
                                Education</h5>
                            <p class="text-muted">Chưa có thông tin</p>
                        </div>

                        <div class="tab-pane" id="timeline">
                            <div class="timeline-alt pb-0">
                                <div class="timeline-item">
                                    <i class="mdi mdi-circle bg-info-lighten text-info timeline-icon"></i>
                                    <div class="timeline-item-info">
                                        <h5 class="mt-0 mb-1">Chưa có hoạt động</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
@endsection
