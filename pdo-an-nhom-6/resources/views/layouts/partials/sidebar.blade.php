<!-- Left Sidebar Start -->
<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a href="{{ route('any', 'index') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="/images/logo-light.png" alt="" height="24">
                    </span>
                </a>
                <a href="{{ route('any', 'index') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="/images/logo-dark.png" alt="" height="24">
                    </span>
                </a>
            </div>

            <ul id="side-menu">

                <li class="menu-title">Danh sách</li>

                <li>
                    <a href="#sidebarDashboards" data-bs-toggle="collapse" style="text-decoration: none;">
                        <i data-feather="home"></i>
                        <span> Tổng quan </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarDashboards">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('any', 'index') }}" class="tp-link">Danh mục chức năng</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="menu-title">Trang quản lý</li>

                <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse"
                       class="{{ request()->is('qlnd/*') ? 'active' : '' }}">
                        <i data-feather="users" style="color: #000;"></i>
                        <span> Quản lý người dùng </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->is('qlnd/*') ? 'show' : '' }}" id="sidebarAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('qlnd.listSinhvien') }}"
                                   class="tp-link {{ request()->routeIs('qlnd.listSinhvien') ? 'active' : '' }}">
                                    <i class="mdi mdi-account-multiple"></i>
                                    <span>Danh sách học sinh</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('qlnd.listGiaovien') }}"
                                   class="tp-link {{ request()->routeIs('qlnd.listGiaovien') ? 'active' : '' }}">
                                    <i class="mdi mdi-account-multiple" style="color: #000;"></i>
                                    <span>Danh sách giáo viên</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('sinhvien.dangky') }}"
                                   class="tp-link {{ request()->routeIs('sinhvien.dangky') ? 'active' : '' }}">
                                    <i class="mdi mdi-account-multiple" style="color: #000;"></i>
                                    <span>Đăng ký lớp</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarHocPhi" data-bs-toggle="collapse">
                        <i data-feather="credit-card"></i>
                        <span>Học phí</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarHocPhi">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('hocphi.index') }}" class="tp-link">
                                    <i data-feather="list"></i>
                                    <span>Danh sách học phí</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('miengiam.index') }}" class="tp-link">
                                    <i data-feather="percent"></i>
                                    <span>Quản lý miễn giảm</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('hocphi.sales') }}" class="tp-link">
                                    <i data-feather="dollar-sign"></i>
                                    <span>Thống kê doanh thu</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarThoiKhoaBieu" data-bs-toggle="collapse">
                        <i data-feather="calendar"></i>
                        <span>Thời khóa biểu</span>
                        <span class="menu-arrow"></span>
                    </a>

                    <div class="collapse" id="sidebarThoiKhoaBieu">
                        <ul class="nav-second-level">
                            @foreach($khoas as $khoa)
                                <li>
                                    <a href="#sidebarKhoa{{ $khoa->id_khoa }}" data-bs-toggle="collapse">
                                        <i data-feather="grid"></i>
                                        <span>{{ $khoa->ten_khoa }}</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarKhoa{{ $khoa->id_khoa }}">
                                        <ul class="nav-third-level">
                                            @foreach($khoa->chuyenNganhs as $cn)
                                                <li>
                                                    <a href="{{ route('schedule.chuyennganh', $cn->id_chuyennganh) }}" class="tp-link">
                                                        <i data-feather="book"></i>
                                                        <span>{{ $cn->ten_chuyennganh }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarLichhoc" data-bs-toggle="collapse">
                        <i data-feather="calendar"></i>
                        <span>Quản lý lịch học</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarLichhoc">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('schedule.create') }}">Thêm lịch học</a>
                            </li>
                        </ul>
                    </div>
                </li>



            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>
<!-- Left Sidebar End -->
