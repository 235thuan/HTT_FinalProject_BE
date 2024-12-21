document.addEventListener('DOMContentLoaded', function() {
    // Utility functions
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function isValidPassword(password) {
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/;
        return passwordRegex.test(password);
    }

    // Modal functions
    window.showModal = function(modalId) {
        document.getElementById(modalId).style.display = 'flex';
    }

    window.hideModal = function(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    // UI state functions
    window.homeLogin = function() {
        const elements1331 = document.querySelectorAll('.home1331');
        const elements1332 = document.querySelectorAll('.home1332');
        
        elements1331.forEach(element => {
            element.style.display = 'none';
        });

        elements1332.forEach(element => {
            element.style.display = 'block';
        });

        // Hide any open dropdowns
        const userDropdown = document.getElementById('homeUserDropdown');
        const dropdownMenu = document.getElementById('homeDropdownMenu');
        
        if (userDropdown) userDropdown.style.display = 'none';
        if (dropdownMenu) dropdownMenu.style.display = 'none';
    }

    window.homeLogout = function() {
        const elements1331 = document.querySelectorAll('.home1331');
        const elements1332 = document.querySelectorAll('.home1332');
        
        elements1331.forEach(element => {
            element.style.display = 'block';
        });

        elements1332.forEach(element => {
            element.style.display = 'none';
        });

        // Hide any open dropdowns
        const userDropdown = document.getElementById('homeUserDropdown');
        const dropdownMenu = document.getElementById('homeDropdownMenu');
        
        if (userDropdown) userDropdown.style.display = 'none';
        if (dropdownMenu) dropdownMenu.style.display = 'none';
    }

    // User dropdown functionality
    const userAvatar = document.querySelector('.home-user-avatar');
    const userDropdown = document.getElementById('homeUserDropdown');

    if (userAvatar && userDropdown) {
        let isDropdownVisible = false;

        userAvatar.addEventListener('click', function(e) {
            e.stopPropagation();
            isDropdownVisible = !isDropdownVisible;
            userDropdown.style.display = isDropdownVisible ? 'block' : 'none';
        });

        document.addEventListener('click', function(e) {
            if (!userDropdown.contains(e.target) && !userAvatar.contains(e.target)) {
                isDropdownVisible = false;
                userDropdown.style.display = 'none';
            }
        });
    }

    // Login form handler
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('login_email').value;
            const password = document.getElementById('login_password').value;

            if (!email || !password) {
                alert('Vui lòng điền đầy đủ thông tin');
                return;
            }

            if (!isValidEmail(email)) {
                alert('Email không hợp lệ');
                return;
            }

            fetch('/client/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email, password })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    hideModal('loginModalContent');
                    window.homeLogin();
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi đăng nhập');
            });
        });
    }

    // Register form handler
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = {
                ho_ten: document.getElementById('register_name').value,
                email: document.getElementById('register_email').value,
                password: document.getElementById('register_password').value,
                password_confirmation: document.getElementById('register_password_confirmation').value,
                user_type: document.querySelector('input[name="userType"]:checked')?.value
            };

            // Validation
            if (!formData.ho_ten || !formData.email || !formData.password || !formData.password_confirmation) {
                alert('Vui lòng điền đầy đủ thông tin');
                return;
            }

            if (!isValidEmail(formData.email)) {
                alert('Email không hợp lệ');
                return;
            }

            if (!isValidPassword(formData.password)) {
                alert('Mật khẩu phải có ít nhất 6 ký tự, bao gồm chữ hoa, chữ thường và số');
                return;
            }

            if (formData.password !== formData.password_confirmation) {
                alert('Mật khẩu xác nhận không khớp');
                return;
            }

            if (!formData.user_type) {
                alert('Vui lòng chọn loại tài khoản');
                return;
            }

            fetch('/client/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    hideModal('registerModalContent');
                    alert('Đăng ký thành công! Vui lòng đăng nhập.');
                    registerForm.reset();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi đăng ký');
            });
        });
    }

    // Logout handler
    const logoutLink = document.querySelector('a[href="#logout"]');
    if (logoutLink) {
        logoutLink.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Bạn có chắc chắn muốn đăng xuất?')) {
                fetch('/client/logout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.homeLogout();
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi đăng xuất');
                });
            }
        });
    }

    // Add this with other window functions
    window.toggleHomeDropdown = function() {
        const dropdownMenu = document.getElementById('homeDropdownMenu');
        const userDropdown = document.getElementById('homeUserDropdown');
        
        // Close other dropdown if open
        if (userDropdown) {
            userDropdown.style.display = 'none';
        }

        // Toggle current dropdown
        if (dropdownMenu) {
            const isVisible = dropdownMenu.style.display === 'block';
            dropdownMenu.style.display = isVisible ? 'none' : 'block';
        }
    }

    // Add click outside handler for both dropdowns
    document.addEventListener('click', function(e) {
        const dropdownMenu = document.getElementById('homeDropdownMenu');
        const avatarImg = document.querySelector('.home1332 img');
        
        if (dropdownMenu && avatarImg) {
            if (!dropdownMenu.contains(e.target) && !avatarImg.contains(e.target)) {
                dropdownMenu.style.display = 'none';
            }
        }
    });

    // Rest of your existing code...
});


