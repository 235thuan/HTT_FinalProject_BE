@extends('thuan.layouts.app')


@section('content')
    <style>
        .home222-wrapper {
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .home222 {
            position: relative; /* For absolute positioning of navigation buttons */
        }

        .home222-track {
            display: flex;
            transition: transform 0.5s ease;
        }

        .home222-group {
            display: flex;
            flex: 0 0 100%;
            gap: 20px; /* Space between items */
        }

        .home2221 {
            flex: 0 0 calc(25% - 15px); /* 4 items per row with gap */
            max-width: calc(25% - 15px);
        }

        .slider-prev,
        .slider-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            z-index: 2;
            border-radius: 50%;
        }

        .slider-prev {
            left: -20px; /* Position outside the content area */
        }

        .slider-next {
            right: -20px; /* Position outside the content area */
        }

        .home2221.empty-slot {
            visibility: hidden; /* Hide empty slots but maintain spacing */
        }

        .home22211 img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 1;
            transition: opacity 0.3s;
        }

        .home22211 img.loading {
            opacity: 0;
        }

        .home22211 img.error {
            opacity: 0.5;
        }
    </style>
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

            @if(isset($error))
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @else
                <div class="home222-wrapper">
                    <div class="home222">
                        @if($chuyenNganhs->isNotEmpty())
                            <a class="slider-prev" onclick="changeCategory(-1)">❮</a>
                            <a class="slider-next" onclick="changeCategory(1)">❯</a>

                            <div class="home222-track">
                                @foreach($chuyenNganhs->chunk(4) as $nhom)
                                    <div class="home222-group">
                                        @foreach($nhom as $chuyenNganh)
                                            <div class="home2221">
                                                <div class="home22211">
                                                    <img src="{{ asset($chuyenNganh->image_url) }}"
                                                         alt="{{ $chuyenNganh->ten_chuyennganh }}"
                                                         onerror="this.onerror=null; this.src='{{ asset('storage/thuan/default.png') }}'"
                                                         loading="lazy">
                                                </div>
                                                <div class="home22212">{{ $chuyenNganh->ten_khoa }}</div>
                                                <div class="home22212">{{ $chuyenNganh->ten_chuyennganh }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>

                            <div class="slider-navigation">
                                @for($i = 0; $i < $soNhom; $i++)
                                    <span class="nav-dot {{ $i === 0 ? 'active' : '' }}"
                                          onclick="goToCategory({{ $i }})"></span>
                                @endfor
                            </div>
                        @else
                            <div class="alert alert-info">
                                Không có dữ liệu chuyên ngành
                            </div>
                        @endif
                    </div>
                </div>
            @endif
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

    <script>
        // Khai báo biến toàn cục
        let currentCategoryIndex = 0;
        let slideInterval;

        /**
         * Hàm chuyển đổi category
         */
        window.changeCategory = function (direction) {
            const track = document.querySelector('.home222-track');
            if (!track) return;

            const groups = document.querySelectorAll('.home222-group');
            const totalGroups = groups.length;

            currentCategoryIndex += direction;

            if (currentCategoryIndex >= totalGroups) {
                currentCategoryIndex = 0;
            } else if (currentCategoryIndex < 0) {
                currentCategoryIndex = totalGroups - 1;
            }

            updateCategorySlider();
        }

        /**
         * Hàm chuyển đến category cụ thể
         */
        window.goToCategory = function (index) {
            currentCategoryIndex = index;
            updateCategorySlider();
            resetSlideInterval();
        }

        /**
         * Cập nhật vị trí slider
         */
        function updateCategorySlider() {
            const track = document.querySelector('.home222-track');
            const groups = document.querySelectorAll('.home222-group');

            if (!track || groups.length === 0) return;

            const groupWidth = groups[0].offsetWidth;
            track.style.transform = `translateX(-${currentCategoryIndex * groupWidth}px)`;

            // Cập nhật trạng thái dots
            const dots = document.querySelectorAll('.nav-dot');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentCategoryIndex);
            });
        }

        /**
         * Bắt đầu auto slide
         */
        function startSlideInterval() {
            if (slideInterval) {
                clearInterval(slideInterval);
            }

            slideInterval = setInterval(() => {
                changeCategory(1);
            }, 5000);
        }

        /**
         * Reset interval khi có tương tác
         */
        function resetSlideInterval() {
            clearInterval(slideInterval);
            startSlideInterval();
        }

        /**
         * Khởi tạo slider
         */
        function initializeSlider() {
            // Kiểm tra xem có dữ liệu không
            const track = document.querySelector('.home222-track');
            const groups = document.querySelectorAll('.home222-group');

            if (!track || groups.length === 0) {
                console.warn('Không tìm thấy phần tử slider hoặc không có dữ liệu');
                return;
            }

            // Khởi tạo slider
            updateCategorySlider();
            startSlideInterval();

            // Thêm sự kiện pause khi hover
            const wrapper = document.querySelector('.home222-wrapper');
            if (wrapper) {
                wrapper.addEventListener('mouseenter', () => clearInterval(slideInterval));
                wrapper.addEventListener('mouseleave', startSlideInterval);
            }

            // Thêm sự kiện cho nút prev/next
            const prevButton = document.querySelector('.slider-prev');
            const nextButton = document.querySelector('.slider-next');

            if (prevButton) {
                prevButton.addEventListener('click', () => {
                    changeCategory(-1);
                    resetSlideInterval();
                });
            }

            if (nextButton) {
                nextButton.addEventListener('click', () => {
                    changeCategory(1);
                    resetSlideInterval();
                });
            }
        }

        // Đảm bảo trang đã load hoàn toàn trước khi khởi tạo slider
        document.addEventListener('DOMContentLoaded', function () {
            // Thêm một chút delay để đảm bảo nội dung đã được render
            setTimeout(() => {
                initializeSlider();
            }, 100);
        });
        function handleImages() {
            const images = document.querySelectorAll('.home22211 img');
            images.forEach(img => {
                img.classList.add('loading');
                img.onload = function() {
                    this.classList.remove('loading');
                };
                img.onerror = function() {
                    this.classList.add('error');
                    this.src = '{{ asset("storage/thuan/default.png") }}';
                };
            });
        }

        document.addEventListener('DOMContentLoaded', handleImages);
    </script>



@endsection

