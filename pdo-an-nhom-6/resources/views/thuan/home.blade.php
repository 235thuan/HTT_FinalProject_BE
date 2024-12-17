@extends('thuan.layouts.app')

@section('content')
<div class="home1-2">
    <div class="video-slider">
        <a class="slider-prev" onclick="changeVideo(-1)">❮</a>
        <a class="slider-next" onclick="changeVideo(1)">❯</a>
        <video id="mainVideo" autoplay muted loop>
            <source src="{{ Vite::asset('resources/video/thuan/ab.mp4') }}" type="video/mp4">
            <source src="{{ Vite::asset('resources/video/thuan/abc.mp4') }}" type="video/mp4">
            <source src="{{ Vite::asset('resources/video/thuan/abcd.mp4') }}" type="video/mp4">
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
                <img src="{{ Vite::asset('resources/image/thuan/homeImage1.png') }}">
            </div>
            <div class="home2122">Image subtitle</div>
        </div>
    </div>
    <div class="home22">
        <div class="home221">Browse Educational Categories</div>
        <div class="home222-wrapper">
            <div class="home222">
                <div class="home222-track">
                    <div class="home2221">
                        <div class="home22211"><img src="{{ Vite::asset('resources/image/thuan/homeImage2.png') }}" alt=""></div>
                        <div class="home22212">Educational Experts Trio</div>
                        <div class="home22212">Alice, Bob, Carol</div>
                    </div>
                    <div class="home2221">
                        <div class="home22211"><img src="{{ Vite::asset('resources/image/thuan/homeImage3.png') }}" alt=""></div>
                        <div class="home22212">TitleImage2</div>
                        <div class="home22212">SubtitleImage2</div>
                    </div>
                    <div class="home2221">
                        <div class="home22211"><img src="{{ Vite::asset('resources/image/thuan/homeImage3.png') }}" alt=""></div>
                        <div class="home22212">Learn with Laughter</div>
                        <div class="home22212">SubtitleImage3</div>
                    </div>
                    <div class="home2221">
                        <div class="home22211"><img src="{{ Vite::asset('resources/image/thuan/homeImage4.png') }}" alt=""></div>
                        <div class="home22212">TitleImage4</div>
                        <div class="home22212">SubtitleImage4</div>
                    </div>
                    <div class="home2221">
                        <div class="home22211"><img src="{{ Vite::asset('resources/image/thuan/homeImage5.png') }}" alt=""></div>
                        <div class="home22212">Start Learning Today!</div>
                        <div class="home22212">SubtitleImage5</div>
                    </div>
                </div>
            </div>
            <div class="slider-controls">
                <button class="slider-prev">❮</button>
                <button class="slider-next">❯</button>
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
                    <button>Đăng ký ngay</button>
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
                    <div class="home242131">
                        <button type="button" class="icon-button">
                            <img src="{{ Vite::asset('resources/image/thuan/homeButtonIcon2.png') }}" alt="">
                        </button>
                    </div>
                    <div class="home242132">Đào tạo hoàn toàn tiếng Anh</div>
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
                    <button>Đăng ký ngay</button>
                </div>
            </div>
        </div>
    </div>

    <div class="home-events">
    <div class="event-header">
        <h2>Sự Kiện Sắp Diễn Ra</h2>
        <p>Các hoạt động và sự kiện nổi bật của trường</p>
    </div>
    <div class="event-grid">
        <div class="event-card">
            <div class="event-date">
                <span class="day">15</span>
                <span class="month">Tháng 8</span>
            </div>
            <div class="event-content">
                <h3>Hội Thảo Công Nghệ AI</h3>
                <p class="event-time"><i class="far fa-clock"></i> 09:00 - 16:00</p>
                <p class="event-location"><i class="fas fa-map-marker-alt"></i> Hội trường A</p>
                <p class="event-desc">Tìm hiểu về ứng dụng AI trong giáo dục và nghiên cứu</p>
                <button class="event-register">Đăng ký tham gia</button>
            </div>
        </div>
        <!-- More event cards -->
    </div>
</div>

<div class="home-achievements">
    <div class="achievement-stats">
        <div class="stat-item">
            <span class="stat-number">15,000+</span>
            <span class="stat-label">Sinh viên</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">500+</span>
            <span class="stat-label">Giảng viên</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">50+</span>
            <span class="stat-label">Đối tác doanh nghiệp</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">95%</span>
            <span class="stat-label">Tỷ lệ việc làm</span>
        </div>
    </div>
</div>

<div class="home-news">
    <div class="news-header">
        <h2>Tin Tức & Thông Báo</h2>
        <a href="#" class="view-all">Xem tất cả</a>
    </div>
    <div class="news-grid">
        <div class="news-card">
            <img src="{{ Vite::asset('resources/image/thuan/news1.jpg') }}" alt="News">
            <div class="news-content">
                <span class="news-date">12 Tháng 8, 2023</span>
                <h3>Lễ tốt nghiệp khóa 2023</h3>
                <p>Hơn 3000 sinh viên đã tốt nghiệp trong năm học 2022-2023...</p>
                <a href="#" class="read-more">Đọc thêm</a>
            </div>
        </div>
        <!-- More news cards -->
    </div>
</div>

<div class="home-partners">
    <h2>Đối Tác Của Chúng Tôi</h2>
    <div class="partner-slider">
        <div class="partner-logo">
            <img src="{{ Vite::asset('resources/image/thuan/partner1.png') }}" alt="Partner 1">
        </div>
        <!-- More partner logos -->
    </div>
</div>
</div>


@endsection

