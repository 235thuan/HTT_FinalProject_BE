<div class="home1331" style="display: {{ Auth::check() ? 'none' : 'block' }}">
    <img src="{{ Vite::asset('resources/image/thuan/homeIcon7.png') }}" alt="Account" class="home-user-avatar">
    <div class="home-user-dropdown" id="homeUserDropdown">
        <div class="home-dropdown-item" onclick="showModal('loginModalContent')">
            <img src="{{ Vite::asset('resources/image/thuan/homeIcon1.png') }}" alt="">
            <span>Đăng nhập</span>
        </div>
        <div class="home-dropdown-item" onclick="showModal('registerModalContent')">
            <img src="{{ Vite::asset('resources/image/thuan/homeIcon2.png') }}" alt="">
            <span>Đăng ký</span>
        </div>
    </div>
    @include('thuan.layouts.home-modals')
</div>

<div class="home1332" style="display: {{ Auth::check() ? 'block' : 'none' }}">
    <div class="user-avatar-wrapper">
        <img src="{{ $userAvatar ?? Vite::asset('resources/image/thuan/homeIcon7.png') }}"
             alt="User Avatar"
             onclick="toggleHomeDropdown()"
             class="user-avatar"
             onerror="this.src='{{ Vite::asset('resources/image/thuan/homeIcon7.png') }}'">
    </div>
    <div id="homeDropdownMenu" class="home-dropdown-content">
        <div class="dropdown-item">
            <a href="../cuong/Trang%20cá%20nhân.html">
                <img src="{{ Vite::asset('resources/image/thuan/homeIcon1.png') }}" alt="">
                <span>Hồ sơ cá nhân</span>
            </a>
        </div>
        <div class="dropdown-item">
            <a href="#settings">
                <img src="{{ Vite::asset('resources/image/thuan/homeIcon2.png') }}" alt="">
                <span>Cài đặt</span>
            </a>
        </div>
        <div class="dropdown-item">
            <a href="#logout">
                <img src="{{ Vite::asset('resources/image/thuan/homeIcon3.png') }}" alt="">
                <span>Đăng xuất</span>
            </a>
        </div>
    </div>
</div>
