<style>
    a {
        color: black;
    }
</style>
<style>
    .nav-guest {
        background: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .nav-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
        height: 70px;
    }

    .logo {
        height: 50px;
    }

    .logo-img {
        height: 100%;
        width: auto;
    }

    .menu-wrapper {
        display: flex;
        gap: 30px;
        height: 100%;
    }

    .menu-item {
        position: relative;
        height: 100%;
        display: flex;
        align-items: center;
    }

    .menu-title {
        padding: 8px 16px;
        cursor: pointer;
        color: #333;
        font-weight: 500;
    }

    .menu-title:hover {
        color: #007bff;
    }

    .no-dropdown {
        text-decoration: none;
    }

    .submenu {
        position: absolute;
        top: 100%;
        left: 0;
        background: white;
        min-width: 220px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        border-radius: 4px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.3s ease;
        z-index: 100;
    }

    .menu-item:hover .submenu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .submenu a {
        display: block;
        padding: 12px 20px;
        color: #333;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .submenu a:hover {
        background-color: #f8f9fa;
        color: #007bff;
    }

    .auth-buttons {
        display: flex;
        gap: 15px;
    }

    .login-btn, .register-btn {
        padding: 8px 20px;
        border-radius: 4px;
        text-decoration: none;
        transition: all 0.3s;
    }

    .login-btn {
        color: #007bff;
        border: 1px solid #007bff;
    }

    .login-btn:hover {
        background: #007bff;
        color: white;
    }

    .register-btn {
        background: #007bff;
        color: white;
    }

    .register-btn:hover {
        background: #0056b3;
    }

    @media (max-width: 768px) {
        .menu-wrapper {
            display: none;
        }
    }
</style>
<style>
    .menu-wrapper {
        display: flex;
        gap: 20px;
        height: 100%;
        align-items: center;
    }

    /* Menu Item Styles */
    .menu-item {
        position: relative;
        height: 100%;
        display: flex;
        align-items: center;
    }

    /* Menu Title Styles */
    .menu-title {
        padding: 8px 16px;
        cursor: pointer;
        color: #6c757d;
        font-weight: 500;
        border-radius: 4px;
        transition: all 0.3s ease;
        background: transparent;
        position: relative;
        overflow: hidden;
    }

    /* Hover effect for menu titles */
    .menu-item:hover .menu-title {
        color: #fff;
        background: linear-gradient(to right, #f9a825, #ff8f00);
        box-shadow: 0 2px 4px rgba(249, 168, 37, 0.3);
    }

    /* Submenu Styles */
    .submenu {
        position: absolute;
        top: 100%;
        left: 0;
        background: white;
        min-width: 220px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        border-radius: 4px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.3s ease;
        z-index: 100;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    /* Show submenu on hover */
    .menu-item:hover .submenu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    /* Submenu Links */
    .submenu a {
        display: block;
        padding: 10px 16px;
        color: #212529;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 14px;
        position: relative;
        overflow: hidden;
    }

    /* Hover effect for submenu items */
    .submenu a:hover {
        background: linear-gradient(to right, #f9a825, #ff8f00);
        color: #fff;
    }

    /* No Dropdown Link Style */
    .no-dropdown {
        text-decoration: none;
        color: #6c757d;
    }

    .no-dropdown:hover {
        color: #fff;
        background: linear-gradient(to right, #f9a825, #ff8f00);
    }

    /* Add divider between submenu items */
    .submenu a:not(:last-child) {
        border-bottom: 1px solid #f0f0f0;
    }

    /* Active state for menu items */
    .menu-item.active .menu-title {
        color: #fff;
        background: linear-gradient(to right, #f9a825, #ff8f00);
    }

    /* Gradient animation on hover */
    @keyframes gradientShift {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    .menu-item:hover .menu-title,
    .submenu a:hover,
    .no-dropdown:hover {
        background-size: 200% auto;
        animation: gradientShift 3s ease infinite;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .menu-wrapper {
            gap: 10px;
        }

        .menu-title {
            padding: 6px 12px;
            font-size: 14px;
        }
    }
</style>
@auth
    <div class="home1">
        <div class="home11">
            <div class="home111">
                <a href="{{ route('home') }}">
                <span class="logo-sm">
                        <img src="/images/logo-sm.png" alt="" height="44">
                    </span>
                </a>

            </div>

        </div>
        <div class="home12">
            <div class="home121">
                <input class="home1211" type="text" placeholder="Tìm kiếm...">
            </div>
        </div>
        <div class="home13">
            <div class="home131">
                <div class="home1311">
                    <a href="{{route('client.chuyennganh')}}"> Chuyên ngành</a>
                </div>
                <div class="home1311">
                    <a href="{{route('client.lophoc')}}"> Lớp học</a>
                </div>
                <div class="home1311">
                    <a href="{{route('client.monhoc')}}"> Môn học</a>
                </div>
            </div>
            <div class="home132">
                <div class="home1321">
                    <img src="{{ Vite::asset('resources/image/thuan/homeIcon1.png') }}"></img>
                </div>
                <div class="home1321">
                    <img src="{{ Vite::asset('resources/image/thuan/homeIcon2.png') }}"></img>
                </div>
                <div class="home1321">
                    <img src="{{ Vite::asset('resources/image/thuan/homeIcon3.png') }}"></img>
                </div>
            </div>
            <div class="home133">
                @include('thuan.layouts.home-dropdown')
            </div>
        </div>
    </div>
@else
    <div class="home1">
        <div class="home11">
            <div class="home111">
                <a href="{{ route('home') }}">
                <span class="logo-sm">
                        <img src="/images/logo-sm.png" alt="" height="44">
                    </span>
                </a>

            </div>

        </div>

        <div class="home13">
            <div class="home131">
                <div class="menu-wrapper">
                    <!-- Giới thiệu -->
                    <div class="menu-item">
                        <span class="menu-title">Giới thiệu</span>
                        <div class="submenu">
                            <a href="#">Tầm nhìn - Sứ mệnh - Giá trị cốt lõi</a>
                            <a href="#">Hình ảnh sinh viên</a>
                            <a href="#">Cơ sở vật chất</a>
                            <a href="#">Cơ cấu tổ chức</a>
                        </div>
                    </div>

                    <!-- Tuyển sinh -->
                    <div class="menu-item">
                        <span class="menu-title">Tuyển sinh</span>
                        <div class="submenu">
                            <a href="#">Chính quy</a>
                            <a href="#">Liên kết đào tạo</a>
                        </div>
                    </div>

                    <!-- Chuyên ngành đào tạo -->
                    <div class="menu-item">
                        <span class="menu-title">Chuyên ngành đào tạo</span>
                        <div class="submenu">
                            <a href="#">Công nghệ kỹ thuật</a>
                            <a href="#">Kinh tế tài chính</a>
                            <a href="#">Ngôn ngữ</a>
                            <a href="#">Y tế sức khỏe</a>
                            <a href="#">Quốc tế</a>
                        </div>
                    </div>

                    <!-- Sự kiện -->
                    <div class="menu-item">
                        <span class="menu-title">Sự kiện</span>
                        <div class="submenu">
                            <a href="#">Tin tức</a>
                            <a href="#">Sinh viên</a>
                            <a href="#">Việc làm</a>
                        </div>
                    </div>

                    <!-- Liên hệ -->
                    <div class="menu-item">
                        <a href="#" class="menu-title no-dropdown">Liên hệ</a>
                    </div>
                </div>
            </div>
            <div class="home133">
                @include('thuan.layouts.home-dropdown')
            </div>
        </div>
    </div>
@endauth



