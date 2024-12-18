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

        .home21 {
            display: flex;
            background: white;
            border-radius: 15px;
            margin: 2rem 0;
            min-height: 400px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .home211 {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 2rem;
            height: 400px;
        }

        .home212 {
            flex: 1;
            height: 400px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .home212:hover {
            transform: scale(1.02);
            box-shadow: -5px 0 15px rgba(0,0,0,0.1);
        }

        .content-wrapper {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            justify-content: center;
            height: 100%;
        }

        .content-wrapper h2 {
            font-size: 2rem;
            color: #2c3e50;
            margin: 0;
            font-weight: 600;
        }

        .subtitle {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.6;
        }

        .action-button {
            margin-top: auto;
            /*align-self: flex-start; !* Align button to the left *!*/
        }

        .action-button button {
            padding: 12px 28px;
            background: linear-gradient(to right, #f9a825, #f57f17); /* Amber/Orange gradient */
            color: black;
            border: none;
            border-radius: 25px; /* More rounded corners like home-events */
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase; /* Match home-events style */
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .action-button button:hover {
            background: linear-gradient(to right, #f57f17, #f9a825); /* Reversed gradient on hover */
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(249, 168, 37, 0.4); /* Updated shadow color to match */
        }

        .action-button button::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(255,255,255,0.1), transparent);
            transform: translateX(-100%);
            transition: transform 0.5s ease;
        }

        .action-button button:hover::after {
            transform: translateX(100%);
        }

        .image-wrapper {
            height: 100%;
            width: 100%;
        }

        .image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .home212:hover .image-wrapper img {
            transform: scale(1.1);
        }

        .image-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1rem;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            color: white;
            font-size: 1.1rem;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }

        .home212:hover .image-caption {
            transform: translateY(0);
        }


        /*button monhoc*/
        .expand-section {
            display: flex;
            justify-content: center;
            padding: 15px 0;
            background: linear-gradient(to bottom, rgba(255,255,255,0), rgba(255,255,255,1));
        }

        .expand-toggle {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 24px;
            background: white;
            border: 1px solid #f57f17;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #f57f17;
            font-weight: 500;
        }

        .expand-toggle:hover {
            background: #f57f17;
            color: white;
        }

        .expand-text {
            font-size: 0.95rem;
        }

        .expand-icon {
            width: 20px;
            height: 20px;
            transition: transform 0.3s ease;
        }

        .expand-toggle:hover .expand-icon {
            filter: brightness(0) invert(1); /* Makes the icon white on hover */
        }

        .expand-toggle.expanded .expand-icon {
            transform: rotate(180deg);
        }

        /* Update the container styles */
        .home2321 {
            max-height: 120px;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .home2321.expanded {
            max-height: 1000px;
        }
        /*end button monhoc*/


        /*chuyennganh slide*/
        .chuyennganh-link {
            text-decoration: none;
            color: inherit;
            display: block;
            transition: all 0.3s ease;
        }

        .chuyennganh-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        /*end chuyen ngah slide*/


        /* Responsive Design */
        @media (max-width: 768px) {
            .home21 {
                flex-direction: column;
                height: auto;
            }

            .home211, .home212 {
                width: 100%;
                height: 300px;
            }

            .content-wrapper h2 {
                font-size: 1.5rem;
            }

            .subtitle {
                font-size: 1rem;
            }
        }
    </style>
    <div class="home1-2">
        <div class="video-slider">
            <a class="slider-prev" onclick="changeVideo(-1)">❮</a>
            <a class="slider-next" onclick="changeVideo(1)">❯</a>
            <video id="mainVideo"  autoplay muted loop playsinline preload="auto">
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
                <div class="content-wrapper">
                    <h2>Nền tảng vững chắc</h2>
                    <p class="subtitle">Hội nhập quốc tế - Vươn tới tương lai</p>
                    <div class="action-button">
                        <button class="hover-effect">Tìm hiểu thêm</button>
                    </div>
                </div>
            </div>
            <div class="home212">
                <div class="image-wrapper">
                    <img src="{{ asset('storage/thuan/homeImage1.png') }}"
                         alt="University Image"
                         onerror="this.src='{{ asset('storage/thuan/default.png') }}'">
                    <div class="image-caption">Môi trường học tập hiện đại</div>
                </div>
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
                                                <a href="{{ route('chuyennganh.show', $chuyenNganh->id_chuyennganh) }}" class="chuyennganh-link">
                                                <div class="home22211">
                                                    <img src="{{ asset($chuyenNganh->image_url) }}"
                                                         alt="{{ $chuyenNganh->ten_chuyennganh }}"
                                                         onerror="this.onerror=null; this.src='{{ asset('storage/thuan/default.png') }}'"
                                                         loading="lazy">
                                                </div>
                                                <div class="home22212">{{ $chuyenNganh->ten_khoa }}</div>
                                                <div class="home22212">{{ $chuyenNganh->ten_chuyennganh }}</div>
                                                </a>
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
                <div class="home2321" id="subjectList">
                    @if(isset($monHocs) && $monHocs->isNotEmpty())
                        @foreach($monHocs as $monHoc)
                            <button>{{ $monHoc->ten_monhoc }}</button>
                        @endforeach
                    @else
                        <div class="alert alert-info">
                            Không có dữ liệu môn học
                        </div>
                    @endif
                </div>
                <div class="expand-section">
                    <button class="expand-toggle" id="expandButton">
                        <span class="expand-text">Xem thêm môn học</span>
                        <img src="{{ asset('storage/thuan/expand-arrow.png') }}"
                             alt="expand"
                             class="expand-icon"
                             onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSIjZjU3ZjE3Ij48cGF0aCBkPSJNNy40MSA4LjU5TDEyIDEzLjE3bDQuNTktNC41OEwxOCAxMGwtNiA2LTYtNiAxLjQxLTEuNDF6Ii8+PC9zdmc+'" />
                    </button>
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


    //     monhoc script
        document.addEventListener('DOMContentLoaded', function() {
            const subjectList = document.getElementById('subjectList');
            const expandButton = document.getElementById('expandButton');
            const expandText = expandButton.querySelector('.expand-text');
            let isExpanded = false;

            function checkIfExpandNeeded() {
                const scrollHeight = subjectList.scrollHeight;
                const clientHeight = subjectList.clientHeight;

                if (scrollHeight <= 120) {
                    expandButton.parentElement.style.display = 'none';
                    subjectList.style.maxHeight = 'none';
                } else {
                    expandButton.parentElement.style.display = 'flex';
                }
            }

            expandButton.addEventListener('click', function() {
                isExpanded = !isExpanded;
                subjectList.classList.toggle('expanded');
                this.classList.toggle('expanded');

                if (isExpanded) {
                    expandText.textContent = 'Thu gọn danh sách';
                    subjectList.style.maxHeight = subjectList.scrollHeight + 'px';
                } else {
                    expandText.textContent = 'Xem thêm môn học';
                    subjectList.style.maxHeight = '120px';
                    subjectList.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            });

            checkIfExpandNeeded();
            window.addEventListener('resize', checkIfExpandNeeded);
        });
    //     end monhoc
    </script>



@endsection

