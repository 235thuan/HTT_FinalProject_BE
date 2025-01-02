@php use Illuminate\Support\Facades\DB; @endphp
@extends('layouts.vertical', ['title' => 'Starter'])

@section('content')
<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">Thông tin cá nhân</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Trang quản lý</a></li>
            <li class="breadcrumb-item active">Thông tin cá nhân </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">

                <div class="align-items-center">
                    <div class="d-flex align-items-center">

                        @if(auth()->user()->avatar_url)
                            <img src="{{ auth()->user()->avatar_url }}"class="rounded-circle avatar-xxl img-thumbnail float-start" alt="ảnh đại diện">
                        @else
                            <img src="/images/users/default-avatar.jpg" class="rounded-circle avatar-xxl img-thumbnail float-start" alt="ảnh đại diện mặc định">
                        @endif
                            <div class="overflow-hidden ms-4">
                                <h4 class="m-0 text-dark fs-20">{{ $userDetails->ten_dang_nhap }}</h4>
                                <p class="my-1 text-muted fs-16">
                                    @php
                                        $vaiTro = DB::table('vaitro')
                                            ->where('id_vaitro', 1)
                                            ->first();
                                    @endphp
                                    {{ $vaiTro ? $vaiTro->ten_vaitro : 'Quản trị viên' }}
                                </p>
                                <span class="fs-15">
            <i class="mdi mdi-message me-2 align-middle"></i>
            Liên hệ: <span>{{ $userDetails->email ?? 'Chưa cập nhật' }}</span>
        </span>
                            </div>
                    </div>
                </div>

                <ul class="nav nav-underline border-bottom pt-2" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active p-2" id="profile_about_tab" data-bs-toggle="tab" href="#profile_about" role="tab">
                            <span class="d-block d-sm-none"><i class="mdi mdi-information"></i></span>
                            <span class="d-none d-sm-block">Thông tin</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-2" id="profile_experience_tab" data-bs-toggle="tab" href="#profile_experience" role="tab">
                            <span class="d-block d-sm-none"><i class="mdi mdi-sitemap-outline"></i></span>
                            <span class="d-none d-sm-block">Kinh nghiệm</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-2" id="portfolio_education_tab" data-bs-toggle="tab" href="#profile_education" role="tab">
                            <span class="d-block d-sm-none"><i class="mdi mdi-school"></i></span>
                            <span class="d-none d-sm-block">Học vấn</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-2" id="setting_tab" data-bs-toggle="tab" href="#profile_setting" role="tab">
                            <span class="d-block d-sm-none"><i class="mdi mdi-cog"></i></span>
                            <span class="d-none d-sm-block">Cài đặt</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content text-muted bg-white">
                    <div class="tab-pane active show pt-4" id="profile_about" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-md-6 mb-4">
                                <div class="">
                                    <h5 class="fs-16 text-dark fw-semibold mb-3 text-capitalize">Giới thiệu</h5>
                                    <p>Xin chào! Tôi là {{ $userDetails->ten_dang_nhap }},
                                        @php
                                            $vaiTro = DB::table('vaitro')
                                                ->where('id_vaitro', 1)
                                                ->first();
                                        @endphp
                                        {{ $vaiTro ? $vaiTro->ten_vaitro : 'Quản trị viên' }} của hệ thống.
                                        Với vai trò này, tôi có trách nhiệm quản lý và điều hành các hoạt động của hệ thống quản lý học phí.
                                    </p>
                                </div>

                                <div class="skills-details mt-3">
                                    <h6 class="text-uppercase fs-13">Kỹ năng</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="badge bg-light px-3 text-dark py-2 fw-semibold">Quản lý hệ thống</span>
                                        <span class="badge bg-light px-3 text-dark py-2 fw-semibold">Quản lý dữ liệu</span>
                                        <span class="badge bg-light px-3 text-dark py-2 fw-semibold">Quản lý người dùng</span>
                                        <span class="badge bg-light px-3 text-dark py-2 fw-semibold">Bảo mật thông tin</span>
                                        <span class="badge bg-light px-3 text-dark py-2 fw-semibold">Phân tích dữ liệu</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-md-6 mb-4">
                                <h5 class="fs-16 text-dark fw-semibold mb-3 text-capitalize">Thông tin liên hệ</h5>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4">
                                        <div class="profile-email">
                                            <h6 class="text-uppercase fs-13">Email</h6>
                                            <a href="mailto:{{ $userDetails->email }}" class="text-primary fs-14 text-decoration-underline">
                                                {{ $userDetails->email }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4">
                                        <div class="profile-email">
                                            <h6 class="text-uppercase fs-13">Mạng xã hội</h6>
                                            <ul class="social-list list-inline mt-0 mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript: void(0);" class="social-item border-primary text-primary justify-content-center align-content-center">
                                                        <i class="mdi mdi-facebook fs-14"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript: void(0);" class="social-item border-danger text-danger justify-content-center align-content-center">
                                                        <i class="mdi mdi-google fs-14"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-lg-4">
                                        <div class="profile-email">
                                            <h6 class="text-uppercase fs-13">Địa chỉ</h6>
                                            <span class="fs-14">Hà Nội, Việt Nam</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="skills-details mt-3">
                                    <h6 class="text-uppercase fs-13">Chức năng chính</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="badge bg-light px-3 py-2 text-dark fw-semibold">Quản lý học phí</span>
                                        <span class="badge bg-light px-3 py-2 text-dark fw-semibold">Quản lý sinh viên</span>
                                        <span class="badge bg-light px-3 py-2 text-dark fw-semibold">Báo cáo thống kê</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-md-6 mb-0">
                                <div class="">
                                    <h5 class="fs-16 text-dark fw-semibold mb-3 text-capitalize">Thống kê hệ thống</h5>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="card border">
                                            <div class="card-body">
                                                <h4 class="m-0 fw-semibold text-dark fs-16">Tổng số sinh viên</h4>
                                                <div class="row mt-2 d-flex align-items-center">
                                                    <div class="col">
                                                        <h5 class="fs-20 mt-1 fw-bold">{{ number_format($totalStudents ?? 0) }}</h5>
                                                        <p class="mb-0 text-muted">Sinh viên</p>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="#" class="btn btn-sm btn-outline-dark px-3">Chi tiết</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="card border">
                                            <div class="card-body">
                                                <h4 class="m-0 fw-semibold text-dark fs-16">Tổng học phí</h4>
                                                <div class="row mt-2 d-flex align-items-center">
                                                    <div class="col">
                                                        <h5 class="fs-20 mt-1 fw-bold">{{ number_format($totalFees ?? 0) }}đ</h5>
                                                        <p class="mb-0 text-muted">Học phí</p>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="#" class="btn btn-sm btn-outline-dark px-3">Chi tiết</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-md-6 mb-0">
                                <div class="">
                                    <h5 class="fs-16 text-dark fw-semibold mb-3 text-capitalize">Tiến độ công việc</h5>
                                </div>

                                <div class="row align-items-center g-0">
                                    <div class="col-sm-3">
                                        <p class="text-truncate mt-1 mb-0">
                                            <i class="mdi mdi-circle-medium text-primary me-2"></i>Học phí đã thu
                                        </p>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="progress mt-1" style="height: 8px;">
                                            <div class="progress-bar progress-bar bg-primary rounded" role="progressbar"
                                                 style="width: {{ (200 / 2) * 100 }}%"
                                                 aria-valuenow="{{ (50 / 2) * 100 }}"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Thêm các tiến độ khác tương tự -->
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane pt-4" id="profile_experience" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-6">
                                <h5 class="fs-16 text-dark fw-semibold mb-3 text-capitalize">Kinh nghiệm làm việc</h5>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <ol class="profile-section list-unstyled mb-0 px-4">
                                        <li class="profile-item">
                                            <div class="avatar-sm profile-icon p-1">
                                                <!-- Giữ nguyên phần SVG icon -->
                                            </div>
                                            <div class="exper-item-list">
                                                <div>
                                                    <h5 class="fs-16 text-dark">Quản trị viên hệ thống</h5>
                                                    <div class="list-inline list-inline-dots mb-1 fs-14">
                                                        <div class="list-inline-item">Trường Đại học</div>
                                                        <div class="list-inline-item list-inline-item-second">Toàn thời gian</div>
                                                    </div>
                                                    <div class="list-inline list-inline-dots mb-2 fs-14">
                                                        <div class="list-inline-item">Tháng 1/2020 - Hiện tại</div>
                                                        <div class="list-inline-item list-inline-item-second">3 năm</div>
                                                    </div>
                                                    <p class="mb-0">Chịu trách nhiệm quản lý và vận hành hệ thống quản lý học phí, quản lý sinh viên và các hoạt động liên quan.</p>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="profile-item">
                                            <div class="avatar-sm profile-icon p-1">
                                                <!-- Giữ nguyên phần SVG icon -->
                                            </div>
                                            <div class="exper-item-list">
                                                <div>
                                                    <h5 class="font-size-16 mb-1">Quản lý đào tạo</h5>
                                                    <div class="list-inline list-inline-dots mb-1 fs-14">
                                                        <div class="list-inline-item">Phòng Đào tạo</div>
                                                        <div class="list-inline-item list-inline-item-second">Toàn thời gian</div>
                                                    </div>
                                                    <div class="list-inline list-inline-dots mb-2 fs-14">
                                                        <div class="list-inline-item">Tháng 2/2016 - Tháng 5/2020</div>
                                                        <div class="list-inline-item list-inline-item-second">4 năm</div>
                                                    </div>
                                                    <p class="mb-0">Quản lý và điều phối các hoạt động đào tạo, xây dựng kế hoạch và chương trình học.</p>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="profile-item pb-0">
                                            <!-- Tiếp tục với các mục kinh nghiệm khác -->
                                        </li>
                                    </ol>
                                </div>

                                <div class="col-md-6 col-sm-6 col-lg-6">
                                    <ol class="profile-section list-unstyled mb-0 px-4">
                                        <li class="profile-item">
                                            <div class="avatar-sm profile-icon p-1">
                                                <!-- Giữ nguyên phần SVG icon -->
                                            </div>
                                            <div class="exper-item-list">
                                                <h5 class="fs-16 text-dark">Chuyên viên CNTT</h5>
                                                <div class="list-inline list-inline-dots mb-1 fs-14">
                                                    <div class="list-inline-item">Phòng CNTT</div>
                                                    <div class="list-inline-item list-inline-item-second">Toàn thời gian</div>
                                                </div>
                                                <div class="list-inline list-inline-dots mb-2 fs-14">
                                                    <div class="list-inline-item">Tháng 6/2010 - Tháng 7/2013</div>
                                                    <div class="list-inline-item list-inline-item-second">3 năm</div>
                                                </div>
                                                <p class="mb-0">Phát triển và bảo trì các hệ thống phần mềm, quản lý cơ sở dữ liệu và hạ tầng CNTT.</p>
                                            </div>
                                        </li>

                                        <!-- Các mục kinh nghiệm khác tương tự -->
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane pt-4" id="profile_education" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-6">
                                <h5 class="fs-16 text-dark fw-semibold mb-3 text-capitalize">Học vấn</h5>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <ol class="profile-section list-unstyled mb-0 px-4">
                                        <li class="profile-item">
                                            <div class="avatar-sm profile-icon p-1">
                                                <div class="avatar-title rounded-2 bg-light" style="height: 40px; width: 40px;">
                                                    <!-- Giữ nguyên SVG icon -->
                                                </div>
                                            </div>
                                            <div class="exper-item-list">
                                                <h5 class="fs-18 text-dark">Đại học Bách Khoa Hà Nội</h5>
                                                <p class="mb-2 fw-semibold text-dark">Thạc sĩ Khoa học Máy tính và Toán học</p>
                                                <div class="list-inline list-inline-dots mb-2 fs-14">
                                                    <div class="list-inline-item">Tháng 1/2018</div>
                                                    <div class="list-inline-item list-inline-item-second">Hà Nội, Việt Nam</div>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                </div>

                                <div class="col-4">
                                    <ol class="profile-section list-unstyled mb-0 px-4">
                                        <li class="profile-item">
                                            <div class="avatar-sm profile-icon p-1">
                                                <div class="avatar-title rounded-2 bg-light" style="height: 40px; width: 40px;">
                                                    <!-- Giữ nguyên SVG icon -->
                                                </div>
                                            </div>
                                            <div class="exper-item-list">
                                                <h5 class="fs-16 text-dark">Đại học Công nghệ - ĐHQGHN</h5>
                                                <p class="mb-2 fw-semibold text-dark">Cử nhân Khoa học Máy tính</p>
                                                <div class="list-inline list-inline-dots mb-2 fs-14">
                                                    <div class="list-inline-item">Tháng 6/2016</div>
                                                    <div class="list-inline-item list-inline-item-second">Hà Nội, Việt Nam</div>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                </div>

                                <div class="col-4">
                                    <ol class="profile-section list-unstyled mb-0 px-4">
                                        <li class="profile-item">
                                            <div class="avatar-sm profile-icon p-1">
                                                <div class="avatar-title rounded-2 bg-light" style="height: 40px; width: 40px;">
                                                    <!-- Giữ nguyên SVG icon -->
                                                </div>
                                            </div>
                                            <div class="exper-item-list">
                                                <h5 class="fs-16 text-dark">THPT Chuyên Hà Nội - Amsterdam</h5>
                                                <p class="mb-2 fw-semibold text-dark">Trung học phổ thông</p>
                                                <div class="list-inline list-inline-dots mb-2 fs-14">
                                                    <div class="list-inline-item">Tháng 2/2015</div>
                                                    <div class="list-inline-item list-inline-item-second">Hà Nội, Việt Nam</div>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end education -->

                    <div class="tab-pane pt-4" id="profile_setting" role="tabpanel">
                        <div class="row">
                            <div class="row">
                                <div class="col-lg-6 col-xl-6">
                                    <div class="card border mb-0">
                                        <div class="card-header">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h4 class="card-title mb-0">Thông tin cá nhân</h4>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="form-group mb-3 row">
                                                <label class="form-label">Họ và tên đệm</label>
                                                <div class="col-lg-12 col-xl-12">
                                                    <input class="form-control" type="text" value="{{ $userDetails->ho_dem ?? '' }}">
                                                </div>
                                            </div>

                                            <div class="form-group mb-3 row">
                                                <label class="form-label">Tên</label>
                                                <div class="col-lg-12 col-xl-12">
                                                    <input class="form-control" type="text" value="{{ $userDetails->ten ?? '' }}">
                                                </div>
                                            </div>

                                            <div class="form-group mb-3 row">
                                                <label class="form-label">Số điện thoại</label>
                                                <div class="col-lg-12 col-xl-12">
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="mdi mdi-phone-outline"></i></span>
                                                        <input class="form-control" type="text" placeholder="Số điện thoại"
                                                               value="{{ $userDetails->so_dien_thoai ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3 row">
                                                <label class="form-label">Địa chỉ Email</label>
                                                <div class="col-lg-12 col-xl-12">
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                                                        <input type="text" class="form-control" placeholder="Email"
                                                               value="{{ $userDetails->email ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3 row">
                                                <label class="form-label">Đơn vị</label>
                                                <div class="col-lg-12 col-xl-12">
                                                    <input class="form-control" type="text" value="{{ $userDetails->don_vi ?? '' }}">
                                                </div>
                                            </div>

                                            <div class="form-group mb-3 row">
                                                <label class="form-label">Tỉnh/Thành phố</label>
                                                <div class="col-lg-12 col-xl-12">
                                                    <input class="form-control" type="text" value="{{ $userDetails->tinh_thanh ?? '' }}">
                                                </div>
                                            </div>

                                            <div class="form-group mb-3 row">
                                                <label class="form-label">Địa chỉ</label>
                                                <div class="col-lg-12 col-xl-12">
                                                    <input class="form-control" type="text" value="{{ $userDetails->dia_chi ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-xl-6">
                                    <div class="card border mb-0">
                                        <div class="card-header">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h4 class="card-title mb-0">Đổi mật khẩu</h4>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body mb-0">
                                            <div class="form-group mb-3 row">
                                                <label class="form-label">Mật khẩu cũ</label>
                                                <div class="col-lg-12 col-xl-12">
                                                    <input class="form-control" type="password" placeholder="Nhập mật khẩu cũ">
                                                </div>
                                            </div>
                                            <div class="form-group mb-3 row">
                                                <label class="form-label">Mật khẩu mới</label>
                                                <div class="col-lg-12 col-xl-12">
                                                    <input class="form-control" type="password" placeholder="Nhập mật khẩu mới">
                                                </div>
                                            </div>
                                            <div class="form-group mb-3 row">
                                                <label class="form-label">Xác nhận mật khẩu</label>
                                                <div class="col-lg-12 col-xl-12">
                                                    <input class="form-control" type="password" placeholder="Nhập lại mật khẩu mới">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-12 col-xl-12">
                                                    <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                                                    <button type="button" class="btn btn-danger">Hủy</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- Tab panes -->
            </div>
        </div>
    </div>
</div>
@endsection
