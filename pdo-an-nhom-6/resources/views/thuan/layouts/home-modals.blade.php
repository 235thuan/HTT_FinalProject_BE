<div class="modal-overlay" id="loginModalContent">
    <div class="modal-content">
        <div>
            <span onclick="hideModal('loginModalContent')" class="close">&times;</span>
        </div>
        <div class="modal-content1">
            <div class="modal-content11">
                <img src="{{ Vite::asset('resources/image/thuan/homeLogo.png') }}" alt="">
            </div>
            <div class="modal-content12" style="margin-left: 60px">Đăng nhập</div>
        </div>
        <form id="loginForm">
            <div class="modal-content2">
                <div style="text-align: left; margin-left: 22px;font-size: large">
                    Email :
                </div>

                <input type="email" id="login_email" placeholder="Email" >
            </div>
            <div class="modal-content2">
                <div style="text-align: left; margin-left: 22px;font-size: large">Mật khẩu: </div>
                <input type="password" id="login_password" placeholder="Mật khẩu" >
            </div>
            <div class="modal-content4">
                <button type="submit">Đăng nhập</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="registerModalContent">
    <div class="modal-content">
        <div>
            <span onclick="hideModal('registerModalContent')" class="close">&times;</span>
        </div>
        <div class="modal-content1">
            <div class="modal-content11">
                <img src="{{ Vite::asset('resources/image/thuan/homeLogo.png') }}" alt="">
            </div>
            <div class="modal-content12" style="margin-left: 60px">Đăng Ký</div>
        </div>
        <form id="registerForm">
            <div class="modal-content2">
                <div style="text-align: left; margin-left: 22px;font-size: large">
                    Họ và tên
                </div>
                <input type="text" id="register_name" placeholder="Họ và tên">
            </div>
            <div class="modal-content2">
                <div style="text-align: left; margin-left: 22px;font-size: large">
                    Email :
                </div>
                <input type="email" id="register_email" placeholder="Email">
            </div>
            <div class="modal-content2">
                <div style="text-align: left; margin-left: 22px;font-size: large">
                    Mật khẩu :
                </div>
                <input type="password" id="register_password" placeholder="Mật khẩu">
            </div>
            <div class="modal-content2">
                <div style="text-align: left; margin-left: 22px;font-size: large">
                    Xác nhận mật khẩu :
                </div>
                <input type="password" id="register_password_confirmation" placeholder="Xác nhận mật khẩu">
            </div>
            <div class="modal-content3">
                <div class="modal-content31">
                    <div class="modal-content311">
                        <input type="radio" name="userType" id="student" value="student">
                    </div>
                    <div class="modal-content312">
                        <label for="student">Sinh viên</label>
                    </div>
                </div>
                <div class="modal-content31">
                    <div class="modal-content311">
                        <input type="radio" name="userType" id="other" value="other">
                    </div>
                    <div class="modal-content312">
                        <label for="other">Khác</label>
                    </div>
                </div>
            </div>
            <div class="modal-content4">
                <button type="submit">Đăng ký</button>
            </div>
        </form>
    </div>
</div>
