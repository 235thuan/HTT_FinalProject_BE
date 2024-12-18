document.addEventListener('DOMContentLoaded', function() {
    // Hàm kiểm tra email hợp lệ
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Hàm kiểm tra mật khẩu hợp lệ (ít nhất 6 ký tự, có chữ hoa, chữ thường và số)
    function isValidPassword(password) {
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/;
        return passwordRegex.test(password);
    }

    // Các hàm xử lý UI
    window.showModal = function(modalId) {
        document.getElementById(modalId).style.display = 'flex';
    }

    window.hideModal = function(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    window.homeLogin = function() {
        var elements = document.querySelectorAll('.home1331');
        elements.forEach(function (element) {
            element.style.display = 'none';
        });

        var showElements = document.querySelectorAll('.home1332');
        showElements.forEach(function (element) {
            element.style.display = 'block';
        });

        hideModal('loginModalContent');
    }

    window.homeLogout = function() {
        var elements = document.querySelectorAll('.home1331');
        elements.forEach(function (element) {
            element.style.display = 'block';
        });

        var hideElements = document.querySelectorAll('.home1332');
        hideElements.forEach(function (element) {
            element.style.display = 'none';
        });
    }

    window.toggleHomeDropdown = function() {
        var dropdown = document.getElementById('homeDropdownMenu');
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    }

    // Xử lý dropdown avatar
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

    // Xử lý form đăng nhập
    const loginForm = document.querySelector('#loginModalContent .modal-content');
    if (loginForm) {
        loginForm.addEventListener('click', function(e) {
            if (e.target && e.target.matches('button')) {
                e.preventDefault();

                const email = loginForm.querySelector('input[type="email"]').value;
                const password = loginForm.querySelector('input[type="password"]').value;

                if (!email || !password) {
                    alert('Vui lòng điền đầy đủ thông tin');
                    return;
                }

                if (!isValidEmail(email)) {
                    alert('Email không hợp lệ');
                    return;
                }

                fetch('/thuan/login', {
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
                        homeLogin();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi đăng nhập');
                });
            }
        });
    }

    // Xử lý form đăng ký
    const registerForm = document.querySelector('#registerModalContent .modal-content');
    if (registerForm) {
        registerForm.addEventListener('click', function(e) {
            if (e.target && e.target.matches('button')) {
                e.preventDefault();

                const formData = {
                    ho_ten: registerForm.querySelector('input[placeholder="Họ và tên"]').value,
                    email: registerForm.querySelector('input[type="email"]').value,
                    password: registerForm.querySelector('input[placeholder="Mật khẩu"]').value,
                    password_confirmation: registerForm.querySelector('input[placeholder="Xác nhận mật khẩu"]').value,
                    user_type: registerForm.querySelector('input[name="userType"]:checked')?.value
                };

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

                fetch('/thuan/register', {
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
            }
        });
    }

    // Xử lý đăng xuất
    const logoutLink = document.querySelector('a[href="#logout"]');
    if (logoutLink) {
        logoutLink.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Bạn có chắc chắn muốn đăng xuất?')) {
                fetch('/thuan/logout', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        homeLogout();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi đăng xuất');
                });
            }
        });
    }

    // Back to top functionality
    const backToTopButton = document.getElementById('backToTop');
    if (backToTopButton) {
        window.onscroll = function() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                backToTopButton.style.display = 'block';
            } else {
                backToTopButton.style.display = 'none';
            }
        };

        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Video slider functionality

    // const video = document.getElementById('mainVideo');
    // const dots = document.getElementsByClassName('nav-dot');
    // let autoPlayInterval;
    //
    // if (video && dots.length > 0) {
    //     let currentVideoIndex = 0;
    //     const sources = Array.from(video.getElementsByTagName('source'));
    //
    //     if (sources.length > 0) {
    //         // Video navigation function
    //         window.changeVideo = function(direction) {
    //             // Remove active class from current dot
    //             dots[currentVideoIndex].classList.remove('active');
    //
    //             // Update index
    //             currentVideoIndex = (currentVideoIndex + direction + sources.length) % sources.length;
    //
    //             // Add active class to new dot
    //             dots[currentVideoIndex].classList.add('active');
    //
    //             // Update video
    //             video.src = sources[currentVideoIndex].src;
    //             video.play().catch(function(error) {
    //                 console.log("Video play failed:", error);
    //             });
    //         }
    //
    //         window.goToVideo = function(index) {
    //             if (index !== currentVideoIndex) {
    //                 dots[currentVideoIndex].classList.remove('active');
    //                 currentVideoIndex = index;
    //                 dots[currentVideoIndex].classList.add('active');
    //
    //                 video.src = sources[currentVideoIndex].src;
    //                 video.play().catch(function(error) {
    //                     console.log("Video play failed:", error);
    //                 });
    //             }
    //         }
    //
    //         // Set first dot as active initially
    //         dots[0].classList.add('active');
    //
    //         // Auto-play next video after 3 seconds
    //         autoPlayInterval = setInterval(function() {
    //             changeVideo(1);
    //         }, 5000); // Increased to 5 seconds for better viewing
    //
    //         // Pause auto-play on hover
    //         video.addEventListener('mouseover', function() {
    //             if (autoPlayInterval) {
    //                 clearInterval(autoPlayInterval);
    //             }
    //         });
    //
    //         video.addEventListener('mouseout', function() {
    //             autoPlayInterval = setInterval(function() {
    //                 changeVideo(1);
    //             }, 5000);
    //         });
    //     }
    // }


    const video = document.getElementById('mainVideo');
    const dots = document.getElementsByClassName('nav-dot');
    let autoPlayInterval;

    if (video && dots.length > 0) {
        let currentVideoIndex = 0;
        const sources = Array.from(video.getElementsByTagName('source'));

        if (sources.length > 0) {
            // Helper function for video playback
            async function playVideo() {
                try {
                    if (video.paused) {
                        video.muted = true;
                        video.playsInline = true;
                        await video.load();
                        await video.play();
                    }
                } catch (error) {
                    // Silently handle power-saving interruptions
                    if (!error.message.includes('interrupted because video-only background media was paused')) {
                        console.log("Video playback issue:", error);
                    }
                }
            }

            // Function to start autoplay
            function startAutoPlay() {
                if (autoPlayInterval) {
                    clearInterval(autoPlayInterval);
                }
                autoPlayInterval = setInterval(() => changeVideo(1), 5000);
            }

            // Video navigation function
            window.changeVideo = async function(direction) {
                // Remove active class from current dot
                dots[currentVideoIndex].classList.remove('active');

                // Update index
                currentVideoIndex = (currentVideoIndex + direction + sources.length) % sources.length;

                // Add active class to new dot
                dots[currentVideoIndex].classList.add('active');

                // Update video
                video.src = sources[currentVideoIndex].src;
                await playVideo();
            }

            window.goToVideo = async function(index) {
                if (index !== currentVideoIndex) {
                    dots[currentVideoIndex].classList.remove('active');
                    currentVideoIndex = index;
                    dots[currentVideoIndex].classList.add('active');

                    video.src = sources[currentVideoIndex].src;
                    await playVideo();
                }
            }

            // Set first dot as active initially
            dots[0].classList.add('active');

            // Start initial autoplay
            startAutoPlay();

            // Pause auto-play on hover
            video.addEventListener('mouseover', () => {
                if (autoPlayInterval) {
                    clearInterval(autoPlayInterval);
                }
            });

            video.addEventListener('mouseout', () => {
                startAutoPlay();
            });

            // Handle visibility changes
            document.addEventListener("visibilitychange", () => {
                if (document.visibilityState === 'visible') {
                    playVideo();
                    startAutoPlay();
                } else {
                    if (autoPlayInterval) {
                        clearInterval(autoPlayInterval);
                    }
                }
            });

            // Handle video end
            video.addEventListener('ended', () => {
                changeVideo(1);
            });

            // Initial video setup
            playVideo();
        }
    }







    // Category slider functionality
    const categoryTrack = document.querySelector('.home222-track');
    const categories = document.querySelectorAll('.home2221');

    if (categories.length > 4) {
        const controls = document.querySelector('.slider-controls');
        if (controls) controls.style.display = 'flex';

        let currentSlide = 0;
        const totalSlides = Math.ceil(categories.length / 4) - 1;

        function updateSlider() {
            const slideWidth = categories[0].offsetWidth * 4 + (3 * 20); // 4 items + 3 gaps
            categoryTrack.style.transform = `translateX(-${currentSlide * slideWidth}px)`;

            // Update controls visibility
            const prevButton = document.querySelector('.slider-prev');
            const nextButton = document.querySelector('.slider-next');
            if (prevButton) prevButton.style.display = currentSlide === 0 ? 'none' : 'flex';
            if (nextButton) nextButton.style.display = currentSlide === totalSlides ? 'none' : 'flex';
        }

        // Previous slide
        document.querySelector('.slider-prev')?.addEventListener('click', () => {
            if (currentSlide > 0) {
                currentSlide--;
                updateSlider();
            }
        });

        // Next slide
        document.querySelector('.slider-next')?.addEventListener('click', () => {
            if (currentSlide < totalSlides) {
                currentSlide++;
                updateSlider();
            }
        });

        // Initial setup
        updateSlider();

        // Update on window resize
        window.addEventListener('resize', updateSlider);
    }










});


