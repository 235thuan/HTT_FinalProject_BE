@extends('layouts.vertical', ['title' => 'Dashboard'])

@section('content')
<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
    </div>
</div>

<!-- start row -->
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="row g-3">
            @foreach($stats as $index => $stat)
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="fs-14 mb-1">{{ $stat['title'] }}</div>
                            </div>

                            <div class="d-flex align-items-baseline mb-2">
                                <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $stat['value'] }}</div>
                                <div class="me-auto">
                                    <span class="text-{{ $stat['trend'] === 'up' ? 'success' : 'danger' }} d-inline-flex align-items-center">
                                        {{ $stat['percent'] }}
                                        <i data-feather="trending-{{ $stat['trend'] }}" class="ms-1" style="height: 22px; width: 22px;"></i>
                                    </span>
                                </div>
                            </div>
                            <div id="{{ ['website-visitors', 'conversion-visitors', 'session-visitors', 'active-users'][$index] }}" class="apex-charts"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div> <!-- end sales -->
</div> <!-- end row -->

<div class="row mt-4">
    <!-- Recent Activities -->
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="header-title">Hoạt động gần đây</h4>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="javascript:void(0);" class="dropdown-item">Tất cả</a>
                        <a href="javascript:void(0);" class="dropdown-item">Học phí</a>
                        <a href="javascript:void(0);" class="dropdown-item">Sinh viên</a>
                    </div>
                </div>
            </div>

            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead>
                        <tr>
                            <th>Thời gian</th>
                            <th>Hoạt động</th>
                            <th>Trạng thái</th>
                            <th>Chi tiết</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ now()->format('d/m/Y H:i') }}</td>
                            <td>Thanh toán học phí</td>
                            <td><span class="badge bg-success">Thành công</span></td>
                            <td><a href="#" class="btn btn-sm btn-light">Xem</a></td>
                        </tr>
                        <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="header-title">Thống kê nhanh</h4>
            </div>
            <div class="card-body pt-0">
                <!-- Payment Status -->
                <div class="mb-4">
                    <h5 class="mb-3">Trạng thái thanh toán</h5>
                    <div class="progress mb-2" style="height: 10px;">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                        <div class="progress-bar bg-warning" style="width: 20%"></div>
                        <div class="progress-bar bg-danger" style="width: 20%"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <small><i class="mdi mdi-circle text-success"></i> Đã thanh toán (60%)</small>
                        <small><i class="mdi mdi-circle text-warning"></i> Đang xử lý (20%)</small>
                        <small><i class="mdi mdi-circle text-danger"></i> Chưa thanh toán (20%)</small>
                    </div>
                </div>

                <!-- Student Distribution -->
                <div>
                    <h5 class="mb-3">Phân bố sinh viên theo khoa</h5>
                    <div class="chart-container" style="height: 200px;">
                        <!-- Add your chart here -->
                        <canvas id="studentDistributionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Calendar and Announcements -->
<div class="row mt-4">
    <!-- Calendar -->
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">Lịch học tháng này</h4>
            </div>
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <!-- Announcements -->
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">Thông báo mới</h4>
            </div>
            <div class="card-body">
                <div class="announcement-list">
                    <div class="announcement-item mb-3 pb-3 border-bottom">
                        <h5 class="mb-1">Thông báo đóng học phí học kỳ mới</h5>
                        <p class="mb-1">Sinh viên vui lòng đóng học phí trước ngày 30/12/2024</p>
                        <small class="text-muted">2 giờ trước</small>
                    </div>
                    <div class="announcement-item">
                        <h5 class="mb-1">Lịch nghỉ Tết Nguyên Đán 2025</h5>
                        <p class="mb-1">Thông báo lịch nghỉ Tết từ ngày 29/01 đến 12/02/2025</p>
                        <small class="text-muted">1 ngày trước</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        // Add your JavaScript for charts and calendar here
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize calendar
            // Initialize charts
            // Add other initializations as needed
        });
    </script>
@endsection
