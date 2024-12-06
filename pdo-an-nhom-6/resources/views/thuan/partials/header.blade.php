<div class="home1">
    <div class="home11">
        <div class="home111">
            <img src="{{ asset('image/thuan/homeIcon4.png') }}">
        </div>
        <div class="home112">Đồ án nhóm 6</div>
    </div>
    <div class="home12">
        <div class="home121">
            <input class="home1211" type="text" placeholder="Tìm kiếm...">
        </div>
    </div>
    <div class="home13">
        <div class="home131">
            <div class="home1311">Item1</div>
            <div class="home1311">Item2</div>
            <div class="home1311">Item3</div>
            <div class="home1311">Item4</div>
        </div>
        <div class="home132">
            <div class="home1321">
                <img src="{{ asset('image/thuan/homeIcon1.png') }}">
            </div>
            <div class="home1321">
                <img src="{{ asset('image/thuan/homeIcon2.png') }}">
            </div>
            <div class="home1321">
                <img src="{{ asset('image/thuan/homeIcon3.png') }}">
            </div>
        </div>
        <div class="home133">
            @guest
                <div class="home1332">
                    <img src="{{ asset('image/thuan/homeAvatar.png') }}" alt="" onclick="toggleAuthDropdown()">
                    <div id="authDropdownMenu" class="dropdown-content" style="display: none;">
                        <a href="#" onclick="showModal('loginModalContent'); return false;">Đăng nhập</a>
                        <a href="#" onclick="showModal('registerModalContent'); return false;">Đăng ký</a>
                    </div>
                </div>

                <!-- Login Modal -->
                <div class="modal-overlay" id="loginModalContent">
                    <div class="modal-content">
                        <div>
                            <span onclick="hideModal('loginModalContent')" class="close">&times;</span>
                        </div>
                        <div class="modal-content1">
                            <div class="modal-content11">
                                <img src="{{ asset('image/thuan/homeLogo.png') }}" alt="">
                            </div>
                            <div class="modal-content12">Đăng nhập</div>
                        </div>
                        <div class="modal-content2">
                            <input type="text" placeholder="Email">
                        </div>
                        <div class="modal-content2">
                            <input type="password" placeholder="Mật khẩu">
                        </div>
                        <div class="modal-content4">
                            <button onclick="login()">Đăng nhập</button>
                        </div>
                    </div>
                </div>

                <!-- Register Modal -->
                <div class="modal-overlay" id="registerModalContent">
                    <div class="modal-content">
                        <div>
                            <span onclick="hideModal('registerModalContent')" class="close">&times;</span>
                        </div>
                        <div class="modal-content1">
                            <div class="modal-content11">
                                <img src="{{ asset('image/thuan/homeLogo.png') }}" alt="">
                            </div>
                            <div class="modal-content12">Đăng Ký</div>
                        </div>
                        <div class="modal-content2">
                            <input type="text" placeholder="Họ và tên">
                        </div>
                        <div class="modal-content2">
                            <input type="text" placeholder="Email">
                        </div>
                        <div class="modal-content2">
                            <input type="password" placeholder="Mật khẩu">
                        </div>
                        <div class="modal-content2">
                            <input type="password" placeholder="Xác nhận mật khẩu">
                        </div>
                        <div class="modal-content3">
                            <div class="modal-content31">
                                <div class="modal-content311">
                                    <input type="radio" name="userType" id="student">
                                </div>
                                <div class="modal-content312">
                                    <label for="student">Sinh viên</label>
                                </div>
                            </div>
                            <div class="modal-content31">
                                <div class="modal-content311">
                                    <input type="radio" name="userType" id="other">
                                </div>
                                <div class="modal-content312">
                                    <label for="other">Khác</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-content4">
                            <button>Đăng ký</button>
                        </div>
                    </div>
                </div>
            @else
                <div class="home1332">
                    <img src="{{ asset('image/thuan/homeAvatar.png') }}" alt="" onclick="toggleDropdown()">
                    <div id="dropdownMenu" class="dropdown-content" style="display: none;">
                        <a href="../cuong/Trang%20cá%20nhân.html">Hồ sơ cá nhân</a>
                        <a href="#settings">Cài đặt</a>
                        <a href="#logout" onclick="logout()">Đăng xuất</a>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</div>