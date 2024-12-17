<div class="home1331">
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
    @include('thuan.layouts.auth-modals')
</div>
<div class="home1332">
    <img src="{{ Vite::asset('resources/image/thuan/homeAvatar.png') }}" alt="" onclick="toggleHomeDropdown()">
    <div id="homeDropdownMenu" class="home-dropdown-content" style="display: none;">
        <a href="../cuong/Trang%20cá%20nhân.html">Hồ sơ cá nhân</a>
        <a href="#settings">Cài đặt</a>
        <a href="#logout" onclick="homeLogout()">Đăng xuất</a>
    </div>
</div> 