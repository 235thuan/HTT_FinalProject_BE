@extends('thuan.layouts.app')


@section('content')
    <style>
        /* Main sections */
        .home1,
        .home1-2,
        .home2 {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            box-sizing: border-box;
        }

        /* Home2 subsections containment */
        .home2 {
            /* Add spacing between sections if needed */
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .home2 > * {
            /* All direct children of home2 */
            width: 100%;
            margin-bottom: 20px; /* Space between sections */
        }

        /* Specific subsections */
        .home21,
        .home22,
        .home23,
        .home24,
        .home-events,
        .home-news,
        .home-achievements,
        .home-partners {

            width: 100%;
            max-width: 1130px; /* Ensure no overflow */
            box-sizing: border-box;
            margin-left: auto;
            margin-right: auto;

        }

        /* Optional: Grid layout for better organization */
        .home2 {
            display: flex;
            flex-direction: column;
            gap: 20px; /* Consistent spacing between sections */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .home1,
            .home1-2,
            .home2 {
                width: 95%;
                padding: 0 10px;
            }

            .home2 > * {
                margin-bottom: 15px; /* Smaller spacing on mobile */
            }
        }

        /* Keep your existing video slider styles */
        .video-slider {
            position: relative;
            width: 100%;
            height: auto;
            aspect-ratio: 16/9;
            overflow: hidden;
        }

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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
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
            background: linear-gradient(to right, rgba(255, 255, 255, 0.1), transparent);
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
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
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
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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

        .video-slider {
            position: relative;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .video-slider video {
            width: 100%;
            height: auto;
            display: block;
        }

        .slider-prev, .slider-next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 2;
            text-decoration: none;
        }

        .slider-next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .slider-prev {
            left: 0;
        }

        .slider-prev:hover, .slider-next:hover {
            background-color: rgba(0, 0, 0, 0.9);
        }

        .home1-2 {
            width: 100%;
            max-width: 1200px; /* Adjust this value to match your design */
            margin: 0 auto;
            position: relative;
        }

        .video-slider {
            position: relative;
            width: 100%;
            height: auto;
            aspect-ratio: 16/9; /* Maintain video aspect ratio */
            overflow: hidden;
        }

        .video-slider video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .slider-prev, .slider-next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 24px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2;
            text-decoration: none;
        }

        .slider-next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .slider-prev {
            left: 0;
        }

        .slider-prev:hover, .slider-next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .home1-2 {
                width: 95%; /* Slightly smaller on mobile */
            }
        }

        /* Common width for all main sections */
        .home1,
        .home1-2,
        .home2 {
            width: 100%;
            max-width: 1200px; /* Adjust this value to match your design */
            margin: 0 auto;
            padding: 0 15px; /* Add some padding for smaller screens */
            box-sizing: border-box;
        }

        /* Video slider specific styles */
        .video-slider {
            position: relative;
            width: 100%;
            height: auto;
            aspect-ratio: 16/9;
            overflow: hidden;
        }

        .video-slider video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Navigation arrows */
        .slider-prev, .slider-next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 24px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2;
            text-decoration: none;
        }

        .slider-next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .slider-prev {
            left: 0;
        }

        .slider-prev:hover, .slider-next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .home1,
            .home1-2,
            .home2 {
                width: 95%;
                padding: 0 10px;
            }
        }

        /* Add these styles for the category slider */
        .home222-wrapper {
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .home222-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .home222-group {
            flex: 0 0 100%;
            width: 100%;
        }
    </style>
    <style>
        .home2321 {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 20px;
            max-height: 300px; /* Chỉ hiển thị 2 dòng ban đầu */
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .home2321.expanded {
            max-height: none; /* Hiển thị tất cả khi expanded */
        }

        .expand-icon {
            transition: transform 0.3s ease;
        }

        .expand-icon.rotated {
            transform: rotate(180deg);
        }
    </style>
    <style>
        .home2321 {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
            max-height: 90px; /* Chiều cao cho 2 dòng button */
            overflow: hidden;
            transition: max-height 0.3s ease;
            padding: 15px;
        }

        .home2321.expanded {
            max-height: none;
        }

        .subject-button {
            width: 100%;
            height: 35px; /* Chiều cao cố định cho mỗi button */
            padding: 8px;
            border: none;
            background: transparent;
            cursor: pointer;
            font-weight: 500;
            transition: color 0.2s;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .subject-button:hover {
            color: #f57f17;
        }

        .expand-icon {
            transition: transform 0.3s ease;
        }

        .expand-icon.rotated {
            transform: rotate(180deg);
        }
    </style>
    <style>
        .home-partners {
            padding: 40px 0;
            background: #fff;
        }

        .home-partners h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 28px;
            background: linear-gradient(to right, black, black);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .partner-slider {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .partner-logo {
            flex: 0 0 200px;
            height: 100px;
            padding: 15px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .partner-logo:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .partner-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            filter: grayscale(100%);
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .partner-logo:hover img {
            filter: grayscale(0%);
            opacity: 1;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .partner-slider {
                gap: 20px;
            }

            .partner-logo {
                flex: 0 0 150px;
                height: 80px;
            }
        }

        /* Animation */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .partner-logo {
            animation: slideIn 0.5s ease forwards;
            animation-delay: calc(var(--i) * 0.1s);
        }
    </style>
    <style>
        .news-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            padding: 20px 0;
            margin-bottom: 30px;
        }

        .title-wrapper {
            position: absolute;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            pointer-events: none; /* Allows clicking through to elements behind */
        }

        .news-header h2 {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin: 0;
            background: linear-gradient(to right,black, black);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            pointer-events: auto; /* Restores clickability to the title */
        }

        .view-all {
            position: relative;
            z-index: 2; /* Ensures the link stays clickable */
            color: #f9a825;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .view-all:hover {
            background: linear-gradient(to right, #f9a825, #ff8f00);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .news-header {
                flex-direction: column;
                gap: 15px;
            }

            .title-wrapper {
                position: relative;
                margin-bottom: 10px;
            }

            .news-header h2 {
                font-size: 24px;
            }
        }
    </style>
    <style>
        .home2321 {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding: 15px;
        }

        .subject-button {
            display: inline-flex;  /* Changed to inline-flex for better centering */
            align-items: center;   /* Vertical center */
            width: 250px;
            justify-content: center; /* Horizontal center */
            min-width: 120px;     /* Minimum width */
            height: 40px;         /* Fixed height */
            padding: 8px 16px;
            margin: 5px;
            border: 1px solid #e0e0e0;
            border-radius: 20px;  /* Rounded corners */
            background: white;
            color: #333;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            white-space: nowrap;  /* Prevent text wrapping */
            overflow: hidden;     /* Hide overflow text */
            text-overflow: ellipsis; /* Show ... for overflow text */
        }

        .subject-button:hover {
            background: linear-gradient(to right, #f9a825, #ff8f00);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            border-color: transparent;
        }

        .subject-button:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Remove focus outline but keep it accessible */
        .subject-button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(249, 168, 37, 0.3);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .subject-button {
                min-width: calc(50% - 20px); /* Two buttons per row on mobile */
                margin: 5px;
            }
        }

        @media (max-width: 480px) {
            .subject-button {
                min-width: calc(100% - 20px); /* Full width on smaller screens */
            }
        }
    </style>
    <style>
        .hover-effect {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f9a825;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .hover-effect:hover {
            /*background-color: #1557b0;*/
            transform: translateY(-2px);
            /*color: white;*/
            text-decoration: none;
            color: #fff;
            background: linear-gradient(to right, #dc9421, #c67507);
            box-shadow: 0 2px 4px rgba(249, 168, 37, 0.3);
        }
    </style>

    @auth
        <div class="home1-2">
            <div class="video-slider">
                <a class="slider-prev" onclick="window.prevVideo()">❮</a>
                <video id="mainVideo" autoplay muted playsinline preload="auto">
                    <source src="{{ Vite::asset('resources/video/thuan/ab.mp4') }}" type="video/mp4">
                </video>
                <a class="slider-next" onclick="window.nextVideo()">❯</a>
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
                <div class="home221">Chuyên ngành đào tạo</div>
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
                                                    <a href="{{ route('chuyennganh.show', $chuyenNganh->id_chuyennganh) }}"
                                                       class="chuyennganh-link">
                                                        <div class="home22211">
                                                            <img src="{{ $chuyenNganh->image_url }}"
                                                                 alt="{{ $chuyenNganh->ten_chuyennganh }}"
                                                                 onerror="this.onerror=null; this.src='/hoa/default.png'"
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
                                <a href="{{ route('client.lophoc') }}" class="subject-button">
                                    {{ $monHoc->ten_monhoc }}
                                </a>
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
                                 onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSIjZjU3ZjE3Ij48cGF0aCBkPSJNNy40MSA4LjU5TDEyIDEzLjE3bDQuNTktNC41OEwxOCAxMGwtNiA2LTYtNiAxLjQxLTEuNDF6Ii8+PC9zdmc+'"/>
                        </button>
                    </div>
                </div>
                <div class="homeLineBreak"></div>
            </div>


            <div class="home24">


                <div class="home241">Đăng ký chuyên ngành</div>
                <div class="home242">
                    @foreach($topChuyenNganhs as $index => $chuyenNganh)
                        <div class="home2421">
                            <div class="home24211">{{ $chuyenNganh->ten_khoa }}</div>
                            <div class="home24212">{{ $chuyenNganh->ten_chuyennganh }}</div>
                            <div class="home24213">
                                <div class="home242131">
                                    <button type="button" class="icon-button">
                                        <img
                                            src="{{ Vite::asset('resources/image/thuan/homeButtonIcon' . ($index + 1) . '.png') }}"
                                            alt="">
                                    </button>
                                </div>
                                <div class="home242132">Chương trình đào tạo kỹ sư bằng chính qui, hệ 4 năm</div>
                            </div>
                            <div class="home24213">
                                <div class="home242131">
                                    <button type="button" class="icon-button">
                                        <img
                                            src="{{ Vite::asset('resources/image/thuan/homeButtonIcon' . ($index + 1) . '.png') }}"
                                            alt="">
                                    </button>
                                </div>
                                <div class="home242132">Hỗ trợ việc làm sau tốt nghiệp</div>
                            </div>
                            <div class="home24213">
                                <div class="home242131">
                                    <button type="button" class="icon-button">
                                        <img
                                            src="{{ Vite::asset('resources/image/thuan/homeButtonIcon' . ($index + 1) . '.png') }}"
                                            alt="">
                                    </button>
                                </div>
                                <div class="home242132">Liên kết học tập sau tốt nghiệp với đối tác nước ngoài</div>
                            </div>
                            <div class="{{ $index === 0 ? 'home24214' : 'home24215' }}">
                                <form
                                    action="{{ route('hoa.hocphi.add', ['id_chuyennganh' => $chuyenNganh->id_chuyennganh]) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit">Đăng ký ngay</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
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
                    <div></div>
                    <h2 >Tin Tức & Thông Báo</h2>
                    <a href="#" class="view-all">Xem tất cả</a>
                </div>
                <div class="news-grid">
                    <div class="news-card">
                        <img src="{{ Vite::asset('resources/image/thuan/news1.jpg') }}" alt="News">
                        <div class="news-content">
                            <span class="news-date">26 Tháng 3, 2025</span>
                            <h3>Lễ tốt nghiệp khóa 2025</h3>
                            <p>Hơn 3000 sinh viên đã tốt nghiệp trong năm học 2022-2025...</p>
                            <a href="#" class="read-more">Đọc thêm</a>
                        </div>
                    </div>
                    <!-- More news cards -->
                </div>
            </div>

            <div class="home-partners">
                <h2 >Đối Tác Của Chúng Tôi</h2>
                <div class="partner-slider">
                    <div class="partner-logo">
                        <img src="{{ Vite::asset('resources/image/thuan/partner1.png') }}" alt="Partner 1">
                    </div>
                    <div class="partner-logo">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Google_2015_logo.svg/2560px-Google_2015_logo.svg.png" alt="Google">
                    </div>
                    <div class="partner-logo">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/IBM_logo.svg/2560px-IBM_logo.svg.png" alt="IBM">
                    </div>
                    <div class="partner-logo">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/08/Netflix_2015_logo.svg/2560px-Netflix_2015_logo.svg.png" alt="Netflix">
                    </div>
                    <div class="partner-logo">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Amazon_logo.svg/2560px-Amazon_logo.svg.png" alt="Amazon">
                    </div>

                </div>
            </div>
        </div>
    @else
        <div class="home1-2">
            <div class="video-slider">
                <a class="slider-prev" onclick="window.prevVideo()">❮</a>
                <video id="mainVideo" autoplay muted playsinline preload="auto">
                    <source src="{{ Vite::asset('resources/video/thuan/ab.mp4') }}" type="video/mp4">
                </video>
                <a class="slider-next" onclick="window.nextVideo()">❯</a>
            </div>
        </div>
        <div class="home2">
            <div class="home21">
                <div class="home211">
                    <div class="content-wrapper">
                        <h2>Nền tảng vững chắc</h2>
                        <p class="subtitle">Hội nhập quốc tế - Vươn tới tương lai</p>
                        <div class="action-button">
                            <a href="{{ route('aboutUs.index') }}" class="hover-effect btn">Tìm hiểu thêm</a>
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
                <div class="home221">Chuyên ngành đào tạo</div>
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
                                                    <a href="{{ route('chuyennganh.show', $chuyenNganh->id_chuyennganh) }}"
                                                       class="chuyennganh-link">
                                                        <div class="home22211">
                                                            <img src="{{ $chuyenNganh->image_url }}"
                                                                 alt="{{ $chuyenNganh->ten_chuyennganh }}"
                                                                 onerror="this.onerror=null; this.src='/hoa/default.png'"
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





            <div class="home24">


                <div class="home241">Đăng ký chuyên ngành</div>
                <div class="home242">
                    @foreach($topChuyenNganhs as $index => $chuyenNganh)
                        <div class="home2421">
                            <div class="home24211">{{ $chuyenNganh->ten_khoa }}</div>
                            <div class="home24212">{{ $chuyenNganh->ten_chuyennganh }}</div>
                            <div class="home24213">
                                <div class="home242131">
                                    <button type="button" class="icon-button">
                                        <img
                                            src="{{ Vite::asset('resources/image/thuan/homeButtonIcon' . ($index + 1) . '.png') }}"
                                            alt="">
                                    </button>
                                </div>
                                <div class="home242132">Chương trình đào tạo kỹ sư bằng chính qui, hệ 4 năm</div>
                            </div>
                            <div class="home24213">
                                <div class="home242131">
                                    <button type="button" class="icon-button">
                                        <img
                                            src="{{ Vite::asset('resources/image/thuan/homeButtonIcon' . ($index + 1) . '.png') }}"
                                            alt="">
                                    </button>
                                </div>
                                <div class="home242132">Hỗ trợ việc làm sau tốt nghiệp</div>
                            </div>
                            <div class="home24213">
                                <div class="home242131">
                                    <button type="button" class="icon-button">
                                        <img
                                            src="{{ Vite::asset('resources/image/thuan/homeButtonIcon' . ($index + 1) . '.png') }}"
                                            alt="">
                                    </button>
                                </div>
                                <div class="home242132">Liên kết học tập sau tốt nghiệp với đối tác nước ngoài</div>
                            </div>
                            <div class="{{ $index === 0 ? 'home24214' : 'home24215' }}">
                                <form
                                    action="{{ route('hoa.hocphi.add', ['id_chuyennganh' => $chuyenNganh->id_chuyennganh]) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit">Đăng ký ngay</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
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
                    <div></div>
                    <h2>Tin Tức & Thông Báo</h2>
                    <a href="#" class="view-all">Xem tất cả</a>
                </div>
                <div class="news-grid">
                    <div class="news-card">
                        <img src="{{ Vite::asset('resources/image/thuan/news1.jpg') }}" alt="News">
                        <div class="news-content">
                            <span class="news-date">26 Tháng 03, 2025</span>
                            <h3>Lễ tốt nghiệp khóa 2025</h3>
                            <p>Hơn 3000 sinh viên đã tốt nghiệp trong năm học 2022-2025...</p>
                            <a href="#" class="read-more">Đọc thêm</a>
                        </div>
                    </div>
                    <!-- More news cards -->
                </div>
            </div>

            <div class="home-partners">
                <h2 >Đối Tác Của Chúng Tôi</h2>
                <div class="partner-slider">
                    <div class="partner-logo">
                        <img src="{{ Vite::asset('resources/image/thuan/partner1.png') }}" alt="Partner 1">
                    </div>
                    <div class="partner-logo">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Google_2015_logo.svg/2560px-Google_2015_logo.svg.png" alt="Google">
                    </div>
                    <div class="partner-logo">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/IBM_logo.svg/2560px-IBM_logo.svg.png" alt="IBM">
                    </div>
                    <div class="partner-logo">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/08/Netflix_2015_logo.svg/2560px-Netflix_2015_logo.svg.png" alt="Netflix">
                    </div>
                    <div class="partner-logo">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Amazon_logo.svg/2560px-Amazon_logo.svg.png" alt="Amazon">
                    </div>

                </div>
            </div>
        </div>
    @endauth

@endsection
@section('scripts')
    <script>
        // Make variables and functions global
        window.videos = [
            '{{ Vite::asset("resources/video/thuan/ab.mp4") }}',
            '{{ Vite::asset("resources/video/thuan/abc.mp4") }}',
            '{{ Vite::asset("resources/video/thuan/abcd.mp4") }}'
        ];

        window.currentVideoIndex = 0;
        window.slideInterval = null;

        // Make functions global
        window.nextVideo = function () {
            window.currentVideoIndex = (window.currentVideoIndex + 1) % window.videos.length;
            updateVideo();
        };

        window.prevVideo = function () {
            window.currentVideoIndex = (window.currentVideoIndex - 1 + window.videos.length) % window.videos.length;
            updateVideo();
        };

        function updateVideo() {
            const videoElement = document.getElementById('mainVideo');
            if (!videoElement) return;

            // Fade out current video
            videoElement.style.opacity = 0;

            setTimeout(() => {
                videoElement.src = window.videos[window.currentVideoIndex];
                videoElement.load();

                const playPromise = videoElement.play();
                if (playPromise !== undefined) {
                    playPromise.then(() => {
                        // Fade in new video
                        videoElement.style.opacity = 1;
                    }).catch(error => {
                        console.log("Video playback error:", error);
                    });
                }
            }, 500); // Wait for fade out

            resetSlideInterval();
        }

        function startSlideInterval() {
            if (window.slideInterval) {
                clearInterval(window.slideInterval);
            }

            // Change video when current video ends
            const videoElement = document.getElementById('mainVideo');
            if (videoElement) {
                videoElement.addEventListener('ended', window.nextVideo);
            }

            // Also set a backup interval
            window.slideInterval = setInterval(window.nextVideo, 15000); // 15 seconds backup
        }

        function resetSlideInterval() {
            clearInterval(window.slideInterval);
            startSlideInterval();
        }

        // Initialize when document is ready
        document.addEventListener('DOMContentLoaded', function () {
            const videoElement = document.getElementById('mainVideo');
            const sliderContainer = document.querySelector('.video-slider');

            if (videoElement && sliderContainer) {
                // Add transition for smooth fade effect
                videoElement.style.transition = 'opacity 0.5s ease-in-out';

                startSlideInterval();

                sliderContainer.addEventListener('mouseenter', () => {
                    clearInterval(window.slideInterval);
                });

                sliderContainer.addEventListener('mouseleave', () => {
                    startSlideInterval();
                });

                videoElement.addEventListener('error', (e) => {
                    console.error('Video error:', e);
                });
            }
        });

        // Add these new functions for category changes
        window.currentCategoryIndex = 0;
        window.categoryInterval;

        window.changeCategory = function (direction) {
            const track = document.querySelector('.home222-track');
            if (!track) return;

            const groups = document.querySelectorAll('.home222-group');
            const totalGroups = groups.length;

            window.currentCategoryIndex += direction;

            // Loop through categories
            if (window.currentCategoryIndex >= totalGroups) {
                window.currentCategoryIndex = 0;
            } else if (window.currentCategoryIndex < 0) {
                window.currentCategoryIndex = totalGroups - 1;
            }

            updateCategorySlider();
            resetCategoryInterval();
        }

        function updateCategorySlider() {
            const track = document.querySelector('.home222-track');
            const groups = document.querySelectorAll('.home222-group');

            if (!track || groups.length === 0) return;

            const groupWidth = groups[0].offsetWidth;
            track.style.transform = `translateX(-${window.currentCategoryIndex * groupWidth}px)`;

            // Update active dots
            const dots = document.querySelectorAll('.nav-dot');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === window.currentCategoryIndex);
            });
        }

        window.goToCategory = function (index) {
            window.currentCategoryIndex = index;
            updateCategorySlider();
            resetCategoryInterval();
        }

        function startCategoryInterval() {
            if (window.categoryInterval) {
                clearInterval(window.categoryInterval);
            }
            window.categoryInterval = setInterval(() => {
                changeCategory(1);
            }, 5000); // Change category every 5 seconds
        }

        function resetCategoryInterval() {
            clearInterval(window.categoryInterval);
            startCategoryInterval();
        }

        // Initialize category slider when document is ready
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize both video and category sliders
            const categoryTrack = document.querySelector('.home222-track');
            if (categoryTrack) {
                updateCategorySlider();
                startCategoryInterval();

                // Pause auto-slide on hover
                const wrapper = document.querySelector('.home222-wrapper');
                if (wrapper) {
                    wrapper.addEventListener('mouseenter', () => {
                        clearInterval(window.categoryInterval);
                    });
                    wrapper.addEventListener('mouseleave', startCategoryInterval);
                }
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const subjectList = document.getElementById('subjectList');
            const expandButton = document.getElementById('expandButton');
            const expandIcon = expandButton.querySelector('.expand-icon');
            const expandText = expandButton.querySelector('.expand-text');

            let isExpanded = false;

            expandButton.addEventListener('click', function () {
                isExpanded = !isExpanded;
                subjectList.classList.toggle('expanded');
                expandIcon.classList.toggle('rotated');
                expandText.textContent = isExpanded ? 'Thu gọn' : 'Xem thêm môn học';
            });
        });
    </script>
    <script>
        // Add animation delay for each logo
        document.querySelectorAll('.partner-logo').forEach((logo, index) => {
            logo.style.setProperty('--i', index);
        });
    </script>
@endsection

