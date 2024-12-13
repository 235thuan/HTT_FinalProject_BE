<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    
    <!-- Vite Assets -->
    @viteReactRefresh
    @vite([
        'resources/css/thuan/homeLayout.css',
        'resources/js/thuan/homeLayout.js'
    ])
</head>
<body>
<div class="home0">
    <div class="home1">
        <div class="home11">
            <div class="home111">
                <img src="{{ Vite::asset('resources/image/thuan/homeIcon4.png') }}">
                </img>
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
                <div class="home1331">
                    <img src="{{ Vite::asset('resources/image/thuan/homeIcon7.png') }}" alt="Account" class="auth-image">
                    <i class="fa-solid fa-user"></i>
                    <div class="auth-dropdown" id="authDropdown">
                        <div class="dropdown-item" onclick="showModal('loginModalContent')">
                            <img src="{{ Vite::asset('resources/image/thuan/homeIcon1.png') }}" alt="">
                            <span>Đăng nhập</span>
                        </div>
                        <div class="dropdown-item" onclick="showModal('registerModalContent')">
                            <img src="{{ Vite::asset('resources/image/thuan/homeIcon2.png') }}" alt="">
                            <span>Đăng ký</span>
                        </div>
                    </div>
                    <div class="modal-overlay" id="loginModalContent">
                        <div class="modal-content">
                            <div>
                                <span onclick="hideModal('loginModalContent')" class="close">
                                    &times;</span>
                            </div>
                            <div class="modal-content1">
                                <div class="modal-content11">
                                    <img src="{{ Vite::asset('resources/image/thuan/homeLogo.png') }}" alt="">
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
                    <div class="modal-overlay" id="registerModalContent">
                        <div class="modal-content">
                            <div>
                                <span onclick="hideModal('registerModalContent')" class="close">
                                    &times;</span>
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
                </div>
                <div class="home1332">
                    <img src="{{ Vite::asset('resources/image/thuan/homeAvatar.png') }}" alt="" onclick="toggleDropdown()">
                    <div id="dropdownMenu" class="dropdown-content" style="display: none;">
                        <a href="../cuong/Trang%20cá%20nhân.html">Hồ sơ cá nhân</a>
                        <a href="#settings">Cài đặt</a>
                        <a href="#logout" onclick="logout()">Đăng xuất</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="home1-2">
        <div class="video-slider">
            <a class="slider-prev" onclick="changeVideo(-1)">❮</a>
            <a class="slider-next" onclick="changeVideo(1)">❯</a>
            <video id="mainVideo" autoplay muted loop>
                <source src="{{ Vite::asset('resources/video/thuan/ab.mp4') }}" type="video/mp4">
                <source src="{{ Vite::asset('resources/video/thuan/abc.mp4') }}" type="video/mp4">
                <source src="{{ Vite::asset('resources/video/thuan/abcd.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="slider-navigation">
                <span class="nav-dot" onclick="goToVideo(0)"></span>
                <span class="nav-dot" onclick="goToVideo(1)"></span>
                <span class="nav-dot" onclick="goToVideo(2)"></span>
            </div>
            <div class="slider-caption">
                <h2>Nền tảng vững chắc</h2>
                <p>Hội nhập quốc tế - Vươn tới tương lai</p>
            </div>
        </div>
    </div>

    <div class="home2">
        <div class="home21">
            <div class="home211">
                <div class="home2110">
                    <div class="home2111">Nền tảng vững chắc - Hội nhập quốc tế - Vươn tới tương lai</div>
                    <div class="home2112">Subtitle</div>
                </div>
                <div class="home2113">
                    <button>Button</button>
                </div>

            </div>
            <div class="home212">
                <div class="home2121">
                    <img src="{{ Vite::asset('resources/image/thuan/homeImage1.png') }}"></img>
                </div>
                <div class="home2122">Image subtitle</div>
            </div>
        </div>
        <div class="home22">
            <div class="home221">Browse Educational Categories</div>
            <div class="home222">
                <div class="home2221">
                    <div class="home22211"><img src="{{ Vite::asset('resources/image/thuan/homeImage2.png') }}" alt=""></div>
                    <div class="home22212">Educational Experts Trio</div>
                    <div class="home22212">Alice, Bob, Carol</div>
                </div>
                <div class="home2221">
                    <div class="home22211"><img src=".image/homeImage3.png') }}" alt=""></div>
                    <div class="home22212">TitleImage2</div>
                    <div class="home22212">SubtitleImage2</div>
                </div>
                <div class="home2221">
                    <div class="home22211"><img src="image/homeImage3.png') }}" alt=""></div>
                    <div class="home22212">Learn with Laughter</div>
                    <div class="home22212">SubtitleImage3</div>
                </div>
                <div class="home2221">
                    <div class="home22211"><img src=".image/homeImage4.png') }}" alt=""></div>
                    <div class="home22212">TitleImage4</div>
                    <div class="home22212">SubtitleImage4</div>
                </div>
                <div class="home2221">
                    <div class="home22211"><img src=".image/homeImage5.png') }}" alt=""></div>
                    <div class="home22212">Start Learning Today!</div>
                    <div class="home22212">SubtitleImage5</div>
                </div>
            </div>
            <div class="homeLineBreak"></div>
        </div>
        <div class="home23">
            <div class="home231">Danh mục môn học</div>
            <div class="home232">
                <div class="home2321">
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                    <button>Button1</button>
                </div>
            </div>
            <div class="homeLineBreak"></div>
        </div>
        <div class="home24">
            <div class="home241">Đăng ký chuyên ngành</div>
            <div class="home242">
                <div class="home2421">
                    <div class="home24211">Khoa CNTT</div>
                    <div class="home24212">Điện tử viễn thông</div>
                    <div class="home24213">
                        <div class="home242131">
                            <button type="button" class="icon-button">
                                <img src="{{ Vite::asset('resources/image/thuan/homeButtonIcon1.png') }}" alt="">
                            </button>
                        </div>
                        <div class="home242132">Chương trình đào tạo kỹ sư điện tử bằng chính qui, hệ 4 năm</div>
                    </div>
                    <div class="home24213">
                        <div class="home242131">
                            <button type="button" class="icon-button">
                                <img src="{{ Vite::asset('resources/image/thuan/homeButtonIcon1.png') }}" alt="">
                            </button>
                        </div>
                        <div class="home242132">Hỗ trợ việc làm sau tốt nghiệp</div>
                    </div>
                    <div class="home24213">
                        <div class="home242131">
                            <button type="button" class="icon-button">
                                <img src="{{ Vite::asset('resources/image/thuan/homeButtonIcon1.png') }}" alt="">
                            </button>
                        </div>
                        <div class="home242132">Liên kết học tập sau tốt nghiệp với đối tác nước ngoài</div>
                    </div>
                    <div class="home24214">
                        <button>
                            Đăng ký ngay
                        </button>
                    </div>
                </div>
                <div class="home2421">
                    <div class="home24211">Khoa Kinh Tế</div>
                    <div class="home24212">Thạc sĩ quản trị kinh doanh</div>
                    <div class="home24213">
                        <div class="home242131">
                            <button type="button" class="icon-button">
                                <img src="{{ Vite::asset('resources/image/thuan/homeButtonIcon2.png') }}" alt="">
                            </button>
                        </div>
                        <div class="home242132">Chương trình đạo tạo do trường Đại Học Colombia Hoa Kỳ cấp bằng</div>
                    </div>
                    <div class="home24213">
                        <div class="home242132">
                            <button type="button" class="icon-button">
                                <img src="{{ Vite::asset('resources/image/thuan/homeButtonIcon2.png') }}" alt="">
                            </button>
                        </div>
                        <div class="home242132">
                            Đào tạo hoàn toàn tiếng Anh
                        </div>
                    </div>
                    <div class="home24213">
                        <div class="home242131">
                            <button type="button" class="icon-button">
                                <img src="{{ Vite::asset('resources/image/thuan/homeButtonIcon2.png') }}" alt="">
                            </button>
                        </div>
                        <div class="home242132">Thời gian đào tạo 18 tháng</div>
                    </div>
                    <div class="home24215">
                        <button>
                            Đăng ký ngay
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="home3">
        <div class="home30">
            <div class="home31">
                <div class="home311">Đồ án nhóm 6</div>
                <div class="home312">Connect with us</div>
                <div class="home313">
                    <div class="home3131"><img src="{{ Vite::asset('resources/image/thuan/homeLinkendi.png') }}"></img></div>
                    <div class="home3131"><img src="{{ Vite::asset('resources/image/thuan/homeFacebook.png') }}"></img></div>
                    <div class="home3131"><img src="{{ Vite::asset('resources/image/thuan/homeYoutube.png') }}"></img></div>

                </div>
            </div>
            <div class="home32">
                <div class="home321">
                    <div class="home3211">Title1</div>
                    <div class="home3212">Subtile1</div>
                </div>
                <div class="home321">
                    <div class="home3211">Title2</div>
                    <div class="home3212">Subtile1</div>
                    <div class="home3212">Subtile2</div>
                    <div class="home3212">Subtile3</div>
                </div>
                <div class="home321">
                    <div class="home3211">Title3</div>
                    <div class="home3212">Subtile1</div>
                    <div class="home3212">Subtile2</div>
                </div>
            </div>
        </div>

    </div>
</div>
</body>
</html>

