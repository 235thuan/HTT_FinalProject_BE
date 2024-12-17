<div class="modal-overlay" id="loginModalContent">
    <div class="modal-content">
        <div>
            <span onclick="hideModal('loginModalContent')" class="close">&times;</span>
        </div>
        <div class="modal-content1">
            <div class="modal-content11">
                <img src="{{ Vite::asset('resources/image/thuan/homeLogo.png') }}" alt="">
            </div>
            <div class="modal-content12">Đăng nhập</div>
        </div>
        <div class="modal-content2">
            <input type="email" placeholder="Email">
        </div>
        <div class="modal-content2">
            <input type="password" placeholder="Mật khẩu">
        </div>
        <div class="modal-content4">
            <button onclick="login()">Đăng nhập</button>
        </div>
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