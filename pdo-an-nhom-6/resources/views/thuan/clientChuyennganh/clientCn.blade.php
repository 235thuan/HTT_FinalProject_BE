@extends('thuan.layouts.app')

@section('content')
    <style>
        /* Đặt font-family chung cho toàn bộ trang */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }

        /* Box model chuẩn để tính toán kích thước chính xác */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        /* Header wrapper should be full width */


        /* Main content wrapper */
        main {
            max-width: 1200px;
            width: 100%;
        }

        /* Icon và Text trong header */


        /* Container for both cards */
        .cards-container {
            position: relative;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            padding: 0 20px;
            margin-bottom: 100px;
        }

        /* Card1 */
        .card1 {
            position: relative;
            width: 100%;
            max-width: 1200px;
            height: 290px;
            margin: 102px auto 0; /* Remove bottom margin */
            background-color: rgba(0, 0, 0, 0.48);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* Explore Text */
        .Exploreoureducationalvideolibrary-text {
            color: #ffffff;
            font-size: 40px;
            font-weight: 600;
            line-height: 60px;
            text-align: center;
            margin-bottom: 20px;
        }

        .Discover-text {
            position: relative;
            color: #ffffff;
            font-size: 20px;
            line-height: 30px;
            text-align: center;
        }

        /* Card2 */
        .card2 {
            position: absolute; /* Position absolute relative to cards-container */
            width: 100%;
            max-width: 844px;
            height: 80px;
            bottom: -40px; /* Position center of card2 at bottom of card1 */
            right: 20px; /* Align to right with some padding */
            background-color: #d9ecff;
            border-radius: 100px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            box-sizing: border-box;
            z-index: 2; /* Keep card2 above card1 */
        }

        /* Text container inside Card2 */
        .text-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .Category-text {
            font-weight: bold;
            color: #030303;
            font-size: 14px;
            line-height: 22px;
        }

        .Browsebytopic-text {
            color: #030303;
            font-size: 14px;
            font-weight: 300;
            line-height: 22px;
        }

        /* Button inside Card2 */
        .button {
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 56px;
            height: 56px;
            border: 0;
            border-radius: 12px;
            color: #ffffff;
            background-color: #0b83ff;
            outline: none;
        }

        .icon5 {
            color: #ffffff;
            fill: #ffffff;
            width: 26px;
            height: 26px;
            font-size: 26px;
        }

        /* Card3 and Image */


        .heart-icon {
            color: #030303;
            fill: #030303;
            width: 14px;
            height: 14px;
            font-size: 14px;
        }


        /* Discover Card Section */
        .Dicover-card {
            position: relative;
            max-width: 1200px;
            width: 100%;
            margin: 100px auto;
            padding: 0 20px;
            background-color: #d9ecff;
            border-radius: 12px;
            display: flex;
            align-items: center;
        }

        .givemoney-icon {
            width: 48px;
            height: 48px;
            fill: #030303;
            margin-left: 76px; /* Keep original positioning */
        }


        .Discoverexclusive-text {
            color: #030303;
            font-size: 16px;
            font-weight: 600;
            line-height: 24px;
            margin-bottom: 5px;
        }

        .Doyouwant-text {
            color: #030303;
            font-size: 14px;
            font-weight: 300;
            line-height: 18px;
        }

        .dangkyhoc-button {
            cursor: pointer;
            width: 216px;
            height: 38px;
            padding: 0 8px;
            border: 1px solid #d3d3d3;
            border-radius: 12px;
            background-color: #ffffff;
            color: #030303;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            line-height: 18px;
            margin-right: 96px; /* Keep original positioning */
        }

        .dangkyhoc-button:hover {
            background-color: #f5f5f5;
        }


        /* Responsive adjustments */
        @media (max-width: 768px) {
            .footer {
                flex-direction: column;
                gap: 30px;
            }
        }

        /* Subjects section */
        .subjects-section {
            max-width: 1200px;
            margin: 100px auto;
            padding: 0 20px;
        }

        .Cacmonhoc-text {
            color: #030303;
            font-size: 20px;
            line-height: 30px;
            margin-bottom: 20px;
            margin-left: 64px;
        }

        .subjects-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            width: 100%;
        }

        .subject-item {
            position: relative;
            width: 100%;
            height: 202px;
        }


        .subject-button {
            position: absolute;
            bottom: 20px;
            left: 20px;
            width: 96px;
            height: 32px;
            border: 0;
            border-radius: 12px;
            background-color: #ffffff;
            color: #030303;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
            line-height: 24px;
            cursor: pointer;
            transition: all 0.3s ease; /* Add smooth transition */
        }

        /* Add hover effect */
        .subject-button:hover {
            background-color: #dc9421;
            color: #ffffff; /* Change text color on hover */
            transform: scale(1.05); /* Slightly increase size on hover */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Add shadow on hover */
        }

        /* Optional: Add hover effect for the entire subject item */
        .subject-item:hover .subject-button {
            background-color: #dc9421;
            color: #ffffff;
            transform: scale(1.05);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .subjects-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (max-width: 992px) {
            .subjects-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .subjects-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .subjects-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Featured Courses Section */
        .courses-section {
            max-width: 1200px;
            margin: 100px auto;
            padding: 0 20px;
        }


        .courses-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            width: 100%;
        }

        .course-item {
            position: relative;
            width: 100%;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
        }

        .course-image {
            position: relative;
            width: 100%;
            height: 184px;
            background-position: center;
            background-size: cover;
            border-radius: 12px;
        }

        .rating-button {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 42px;
            height: 26px;
            background-color: #0b83ff;
            color: #ffffff;
            border: none;
            border-radius: 12px;
            font-size: 12px;
            line-height: 16px;
            cursor: pointer;
        }

        .heart-button {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 24px;
            height: 24px;
            background-color: #ffffff;
            border: none;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .heart-icon {
            width: 14px;
            height: 14px;
            fill: #030303;
        }

        .course-info {
            padding: 15px;
            position: relative;
        }

        .course-title {
            color: #030303;
            font-size: 16px;
            line-height: 24px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .course-subtitle {
            color: #030303;
            font-size: 16px;
            line-height: 24px;
            margin-bottom: 5px;
        }

        .course-price {
            color: #030303;
            font-size: 16px;
            line-height: 24px;
        }

        .arrow-icon {
            position: absolute;
            right: 15px;
            bottom: 15px;
            width: 14px;
            height: 14px;
            fill: #030303;
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .courses-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 992px) {
            .courses-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .courses-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Add this new common style */
        .section-title {
            color: #030303;
            font-size: 20px;
            font-family: 'Poppins', sans-serif;
            line-height: 30px;
            margin-bottom: 20px;
            text-align: left;
            padding-left: 0; /* Remove the left padding */
        }

        /* Update the sections to have proper spacing */
        .subjects-section,
        .courses-section {
            max-width: 1200px;
            margin: 100px auto;
            padding: 0 20px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            position: relative;
            background-color: #fff;
            margin: 30px auto;
            padding: 20px;
            width: 95%;
            max-width: 1200px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .modal-header h2 {
            color: #030303;
            margin: 0;
        }

        .close {
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            color: #666;
        }

        .close:hover {
            color: #000;
        }

        /* Updated Schedule Grid Styles */
        .schedule-grid {
            display: grid;
            grid-template-columns: 100px repeat(6, 1fr);
            gap: 1px;
            background-color: #eee;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        .time-column, .day-column {
            background-color: #fff;
        }

        .time-header, .day-header {
            padding: 15px;
            background-color: #0b83ff;
            color: #fff;
            text-align: center;
        }

        .day-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .date {
            font-size: 0.9em;
            opacity: 0.9;
        }

        .time-slot {
            padding: 30px 10px;
            text-align: right;
            border-bottom: 1px solid #eee;
            font-weight: 500;
        }

        .schedule-slot {
            padding: 15px;
            border-bottom: 1px solid #eee;
            min-height: 90px;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        .schedule-slot:hover {
            background-color: #e3f2fd;
        }

        .course-name {
            font-weight: bold;
            color: #0b83ff;
            margin-bottom: 5px;
        }

        .course-time {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 3px;
        }

        .course-class {
            font-size: 0.9em;
            color: #888;
        }
    </style>
    <style>
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 10px;

            .container {
                background-color: whitesmoke;
            }
        }
    </style>
    <style>
        /* Base styles */
        .subjects-section {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Grid layout */
        .subjects-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 20px;
            opacity: 1;
            transform: translateY(0);
            transition: all 0.3s ease-in-out;
        }

        /* Subject items */
        .subject-item {
            position: relative;
            width: 100%;
            aspect-ratio: 16/9;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            align-items: center;
            justify-content: center;
        }

        .subject-image {
            position: relative;
            width: 100%;
            height: 100%;
            transition: all 0.3s ease;
            background-position: center;
            background-repeat: no-repeat;
            align-items: center;
            justify-content: center;
        }

        .subject-img {

            width: 70%;
            height: 100%;
            object-fit: contain;
            background-position: center;
            background-repeat: no-repeat;
            align-items: center;
            justify-content: center;
        }

        .subject-button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #dc9421;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            margin-top: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid #dc9421;
            text-align: center;
            /* Handle text overflow */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 90%; /* Limit width to show ellipsis */

        }

        .subject-button:hover {
            background: linear-gradient(to right, #bc7f1d, #975905);
            box-shadow: 0 2px 4px rgba(249, 168, 37, 0.3);
            transform: translateY(-2px);
        }

        /* Show full text on hover */
        .subject-button:hover::after {
            content: attr(title); /* Uses the title attribute as content */
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            padding: 5px 10px;
            background-color: #dc9421;
            color: white;
            border-radius: 4px;
            font-size: 14px;
            white-space: normal; /* Allow text wrapping in tooltip */
            max-width: 200px; /* Maximum tooltip width */
            z-index: 1000;
            margin-bottom: 5px;
        }

        /* Expand section */
        .expand-section {
            text-align: center;
            margin-top: 20px;
        }

        .expand-toggle {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background-color: #dc9421;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .expand-toggle:hover {
            background: linear-gradient(to right, #bc7f1d, #975905);
            box-shadow: 0 2px 4px rgba(249, 168, 37, 0.3);
            transform: translateY(-2px);

        }

        .expand-icon {
            width: 20px;
            height: 20px;
            transition: transform 0.3s ease;
        }

        /* States */
        .hidden {
            display: none;
            opacity: 0;
            transform: translateY(-20px);
        }

        .expand-toggle.expanded {
            background-color: #0969d7;
        }

        .expand-toggle.expanded .expand-icon {
            transform: rotate(180deg);
        }

        /* Responsive breakpoints */
        @media (max-width: 1200px) {
            .subjects-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 992px) {
            .subjects-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .subjects-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .hidden {
            display: none !important;
        }

        .img-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 576px) {
            .subjects-grid {
                grid-template-columns: 1fr;
            }
        }


    </style>

    <style>
        .form-select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        #so_sinh_vien {
            padding: 8px;
            background-color: #f5f5f5;
            border-radius: 4px;
        }
    </style>
  <style>
      .card2 {
          background: #f8f9fa;
          padding: 20px;
          border-radius: 8px;
          display: grid;
          grid-template-columns: repeat(4, 1fr) auto;
          gap: 15px;
          align-items: center;
      }

      .text-container {
          display: flex;
          flex-direction: column;
          gap: 8px;
      }

      .Category-text {
          font-size: 14px;
          font-weight: 500;
          color: #495057;
      }

      .Browsebytopic-text {
          font-size: 14px;
          color: #212529;
      }

      /* Select dropdown */
      .form-select {
          padding: 8px;
          border: 1px solid #dee2e6;
          border-radius: 4px;
          width: 100%;
          background: white;
      }

      /* Date inputs */
      .form-control {
          padding: 8px;
          border: 1px solid #dee2e6;
          border-radius: 4px;
          width: 100%;
          background: white;
      }

      /* Search button */
      .button {

          background: #dc9421;
          border: none;
          border-radius: 4px;
          width: 40px;
          height: 40px;
          display: flex;
          align-items: center;
          justify-content: center;
          cursor: pointer;
      }

      .button:hover {
          background: linear-gradient(to right, #b57a1c, #c67507);
          box-shadow: 0 2px 4px rgba(249, 168, 37, 0.3);
      }

      .icon5 {
          width: 16px;
          height: 16px;
          fill: white;
      }

      /* Responsive */
      @media (max-width: 768px) {
          .card2 {
              grid-template-columns: 1fr;
          }

          .button {
              width: 100%;
          }
      }
  </style>

    @php
        $defaultImageUrl = 'https://images.unsplash.com/photo-1484335629320-0e089b87a106?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3wyMDUzMDJ8MHwxfHNlYXJjaHw1fHxNYXRoJTJDJTIwTnVtYmVycyUyQyUyMEVxdWF0aW9uc3xlbnwxfHx8fDE3MjkxOTkxMzJ8MA&ixlib=rb-4.0.3&q=80&w=1080';
    @endphp
    <main>
        <div class="container ">
            <div class="cards-container">
                <!-- Card 1 -->
                <div class="card1">
                    <div class="Exploreoureducationalvideolibrary-text">
                        Khám phá thư viện video giáo dục của chúng tôi
                    </div>
                    <div class="Discover-text">
                        Khám phá thế giới kiến thức với 1.480.086 tài nguyên!
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="card2">
                    <div class="text-container">
                        <div class="Category-text">Học Kỳ</div>
                        <select class="form-select Browsebytopic-text" id="hocky">
                            <option value="">Chọn học kỳ</option>
                            <option value="1">Học kỳ 1</option>
                            <option value="2">Học kỳ 2</option>
                            <option value="3">Học kỳ 3</option>
                            <option value="4">Học kỳ 4</option>
                        </select>
                    </div>
                    <div class="text-container">
                        <div class="Category-text">Ngày bắt đầu</div>
                        <input type="date"
                               class="form-control"
                               id="ngay_bat_dau"
                               name="ngay_bat_dau"
                               min="{{ date('Y-m-d') }}"
                        >
                    </div>

                    <!-- Ngày kết thúc -->
                    <div class="text-container">
                        <div class="Category-text">Ngày kết thúc</div>
                        <input type="date"
                               class="form-control"
                               id="ngay_ket_thuc"
                               name="ngay_ket_thuc"
                               min="{{ date('Y-m-d') }}"
                        >
                    </div>

                    <!-- Số học viên -->
                    <div class="text-container">
                        <div class="Category-text">Số học viên</div>
                        <div class="Browsebytopic-text" id="so_sinh_vien">
                            {{ $soSinhVien ?? 'Đang tải...' }}
                        </div>
                    </div>

                    <button class="button" title="Tìm kiếm">
                        <svg class="icon5" viewBox="0 0 448 512" aria-hidden="true">
                            <path d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Subjects Section -->
            <div class="subjects-section">
                <div class="section-title">Các môn học</div>
                @if(!$isLoggedIn)
                    <div class="alert alert-info">Vui lòng đăng nhập để xem danh sách môn học</div>
                @elseif(!$userRole)
                    <div class="alert alert-info">Tài khoản của bạn không phải là sinh viên hoặc giáo viên</div>
                @elseif($monHocs->isEmpty())
                    <div class="alert alert-info">
                        @if($userRole === 'student')
                            Không có môn học nào cho lớp của bạn
                        @else
                            Không có môn học nào cho khoa của bạn
                        @endif
                    </div>
                @else
                    {{-- First row (always visible) --}}
                    <div class="subjects-grid">
                        @foreach($monHocs->take(4) as $monHoc)
                            <div class="subject-item">
                                <div class="subject-image " style="padding: 5px;
    border-radius: 12px;">
                                    <div class="img-container">
                                        <img src="{{ $monHoc->image_url ?? $defaultImageUrl }}"
                                             alt="{{ $monHoc->ten_monhoc }}"
                                             class="subject-img">
                                    </div>


                                    <a href="{{ route('client.lophoc', ['id' => $monHoc->id_monhoc]) }}"
                                       class="subject-button" title="{{ $monHoc->ten_monhoc }}">
                                        {{ $monHoc->ten_monhoc }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Additional rows (initially hidden) --}}
                    @if($monHocs->count() > 4)
                        <div id="expandedItems" class="hidden">
                            @foreach($monHocs->skip(4)->chunk(4) as $rowMonHocs)
                                <div class="subjects-grid">
                                    @foreach($rowMonHocs as $monHoc)
                                        <div class="subject-item">
                                            <div class="subject-image ">
                                                <div class="img-container">
                                                    <img src="{{ $monHoc->image_url ?? $defaultImageUrl }}"
                                                         alt="{{ $monHoc->ten_monhoc }}"
                                                         class="subject-img">
                                                </div>
                                                <a href="{{ route('client.lophoc', ['id' => $monHoc->id_monhoc]) }}"
                                                   class="subject-button" title="{{ $monHoc->ten_monhoc }}">
                                                    {{ $monHoc->ten_monhoc }}
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                        <div class="expand-section">
                            <button id="expandButton" class="expand-toggle">
                                <span class="expand-text">Xem thêm môn học</span>
                                <img src="{{ asset('storage/thuan/expand-arrow.png') }}"
                                     alt="expand"
                                     class="expand-icon">
                            </button>
                        </div>
                    @endif
                @endif
            </div>

            <!-- Featured Courses Section -->
            <div class="courses-section">
                <div class="section-title">Lớp học</div>

                @if(!$isLoggedIn)
                    <div class="alert alert-info">
                        Vui lòng đăng nhập để xem danh sách lớp học
                    </div>
                @elseif(!$userRole)
                    <div class="alert alert-info">
                        Tài khoản của bạn không phải là sinh viên hoặc giáo viên
                    </div>
                @elseif($lops->isEmpty())
                    <div class="alert alert-info">
                        @if($userRole === 'student')
                            Không có lớp học nào cho chuyên ngành của bạn
                        @else
                            Không có lớp học nào cho khoa của bạn
                        @endif
                    </div>
                @else
                    <div class="courses-grid">
                        @foreach($lops as $lop)
                            <div class="course-item">
                                <div class="course-image"
                                     style="background-image: url('https://images.unsplash.com/photo-1578593139939-cccb1e98698c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3wyMDUzMDJ8MHwxfHNlYXJjaHwzfHxDbGFzc3Jvb218ZW58MXx8fHwxNzI5MjM3ODM1fDA&ixlib=rb-4.0.3&q=80&w=1080');">
                                    <button class="rating-button" title="Niên khóa ">{{ $lop->nam_vao_hoc }}</button>
{{--                                    <button class="heart-button" title="Thêm vào yêu thích">--}}
{{--                                        <svg class="heart-icon" viewBox="0 0 512 512">--}}
{{--                                            <path d="M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z"/>--}}
{{--                                        </svg>--}}
{{--                                    </button>--}}
                                </div>
                                <div class="course-info">
                                    <div class="course-title">{{ $lop->ten_lop }}</div>
                                    <div class="course-subtitle">{{ $lop->ten_chuyennganh }}</div>
                                    <div class="course-price" title="Số lượng sinh viên "> Sĩ số lớp : {{ $lop->so_luong_sv }} sinh viên </div>
                                    <svg class="arrow-icon" viewBox="0 0 320 512">
                                        <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/>
                                    </svg>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Discover Card -->
            <div class="Dicover-card">
                <svg class="givemoney-icon" viewBox="0 0 576 512">
                    <path d=""></path>
                </svg>
                <div class="Discoverexclusive-text">
                    Khám phá các ưu đãi độc quyền và tài nguyên giáo dục! Tham gia cộng đồng học tập ngay!
                </div>
                <div class="Doyouwant-text">
                    Bạn muốn cập nhật nội dung giáo dục và tài nguyên mới nhất? Đăng ký nhận bản tin của chúng tôi!
                </div>
                <button class="dangkyhoc-button"> Khám phá sự kiện </button>
            </div>
        </div>

    </main>
    <div id="scheduleModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Lịch Sự Kiện Trong Tuần</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <div class="schedule-grid">
                    <!-- Schedule will be generated here -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        // Dữ liệu mô phỏng từ cơ sở dữ liệu
        const scheduleData = {
            timeSlots: ['Buổi Sáng', 'Buổi Chiều', 'Buổi Tối'],
            days: [
                {
                    name: 'Thứ Hai',
                    date: '18/03',
                    schedule: [
                        {
                            time: 'Buổi Sáng',
                            courseName: 'Lễ Khai giảng Năm học mới',
                            courseTime: '8:00 - 10:00',
                            className: 'Hội trường A1'
                        },
                        {
                            time: 'Buổi Chiều',
                            courseName: 'Hội thảo Kỹ năng mềm',
                            courseTime: '13:00 - 15:00',
                            className: 'Phòng hội thảo B2'
                        },
                        {
                            time: 'Buổi Tối',
                            courseName: 'Giao lưu Sinh viên Quốc tế',
                            courseTime: '18:00 - 20:00',
                            className: 'Hội trường C3'
                        }
                    ]
                },
                {
                    name: 'Thứ Ba',
                    date: '19/03',
                    schedule: [
                        {
                            time: 'Buổi Sáng',
                            courseName: 'Triển lãm Đồ án Sinh viên',
                            courseTime: '8:00 - 10:00',
                            className: 'Sảnh D1'
                        },
                        {
                            time: 'Buổi Chiều',
                            courseName: 'Tọa đàm Hướng nghiệp',
                            courseTime: '13:00 - 15:00',
                            className: 'Hội trường B5'
                        },
                        {
                            time: 'Buổi Tối',
                            courseName: 'Gặp gỡ Doanh nghiệp',
                            courseTime: '18:00 - 20:00',
                            className: 'Phòng họp E2'
                        }
                    ]
                },
                {
                    name: 'Thứ Tư',
                    date: '20/03',
                    schedule: [
                        {
                            time: 'Buổi Sáng',
                            courseName: 'Hội thi Sáng tạo Kỹ thuật',
                            courseTime: '8:00 - 10:00',
                            className: 'Hội trường A2'
                        },
                        {
                            time: 'Buổi Chiều',
                            courseName: 'Cuộc thi Lập trình',
                            courseTime: '13:00 - 15:00',
                            className: 'Phòng Lab C4'
                        },
                        {
                            time: 'Buổi Tối',
                            courseName: 'Đêm Nhạc Sinh viên',
                            courseTime: '18:00 - 20:00',
                            className: 'Sân khấu D3'
                        }
                    ]
                },
                {
                    name: 'Thứ Năm',
                    date: '21/03',
                    schedule: [
                        {
                            time: 'Buổi Sáng',
                            courseName: 'Diễn đàn Sinh viên',
                            courseTime: '8:00 - 10:00',
                            className: 'Trung tâm A3'
                        },
                        {
                            time: 'Buổi Chiều',
                            courseName: 'Hội thao Thể thao',
                            courseTime: '13:00 - 15:00',
                            className: 'Sân vận động B4'
                        },
                        {
                            time: 'Buổi Tối',
                            courseName: 'Đêm Giao lưu Văn nghệ',
                            courseTime: '18:00 - 20:00',
                            className: 'Sảnh C5'
                        }
                    ]
                },
                {
                    name: 'Thứ Sáu',
                    date: '22/03',
                    schedule: [
                        {
                            time: 'Buổi Sáng',
                            courseName: 'Hội nghị Khoa học',
                            courseTime: '8:00 - 10:00',
                            className: 'Hội trường D2'
                        },
                        {
                            time: 'Buổi Chiều',
                            courseName: 'Triển lãm Công nghệ',
                            courseTime: '13:00 - 15:00',
                            className: 'Khu trưng bày E1'
                        },
                        {
                            time: 'Buổi Tối',
                            courseName: 'Đêm hội Sáng tạo',
                            courseTime: '18:00 - 20:00',
                            className: 'Sân khấu F3'
                        }
                    ]
                },
                {
                    name: 'Thứ Bảy',
                    date: '23/03',
                    schedule: [
                        {
                            time: 'Buổi Sáng',
                            courseName: 'Ngày hội Việc làm',
                            courseTime: '8:00 - 10:00',
                            className: 'Trung tâm A4'
                        },
                        {
                            time: 'Buổi Chiều',
                            courseName: 'Hội thảo Khởi nghiệp',
                            courseTime: '13:00 - 15:00',
                            className: 'Hội trường B1'
                        },
                        {
                            time: 'Buổi Tối',
                            courseName: 'Lễ Tổng kết Sự kiện',
                            courseTime: '18:00 - 20:00',
                            className: 'Sảnh C1'
                        }
                    ]
                }
            ]
        };

        // Function to generate schedule HTML
        function generateSchedule(data) {
            // Generate time column
            const timeColumn = `
        <div class="time-column">
            <div class="time-header" style="height: 70px">Thời Gian</div>
            ${data.timeSlots.map(slot => `
                <div class="time-slot" style="height: 110px" ">${slot}</div>
            `).join('')}
        </div>
    `;

            // Generate day columns
            const dayColumns = data.days.map(day => `
        <div class="day-column">
            <div class="day-header">
                <div class="day-name">${day.name}</div>
                <div class="date">${day.date}</div>
            </div>
            ${data.timeSlots.map(timeSlot => {
                const scheduleItem = day.schedule.find(item => item.time === timeSlot);
                return scheduleItem ? `
                    <div class="schedule-slot" style="height: 110px;">
                        <div class="course-name">${scheduleItem.courseName}</div>
                        <div class="course-time">${scheduleItem.courseTime}</div>
                        <div class="course-class">${scheduleItem.className}</div>
                    </div>
                ` : `
                    <div class="schedule-slot"></div>
                `;
            }).join('')}
        </div>
    `).join('');

            return timeColumn + dayColumns;
        }

        // Update the modal content when clicking the registration button
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('scheduleModal');
            const closeBtn = document.querySelector('.close');
            const dangKyButton = document.querySelector('.dangkyhoc-button');
            const scheduleGrid = document.querySelector('.schedule-grid');

            // Add click event to registration button
            dangKyButton.addEventListener('click', () => {
                // Generate and update schedule content
                scheduleGrid.innerHTML = generateSchedule(scheduleData);
                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            });

            // Close modal when clicking the close button
            closeBtn.addEventListener('click', () => {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            });

            // Close modal when clicking outside
            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });
        });


    </script>


    <script>
        console.log('check script');
        document.addEventListener('DOMContentLoaded', function () {
            const expandButton = document.getElementById('expandButton');
            const expandedItems = document.getElementById('expandedItems');
            const expandText = document.querySelector('.expand-text');
            const expandIcon = document.querySelector('.expand-icon');

            if (expandButton && expandedItems) {
                expandButton.addEventListener('click', function () {
                    // Toggle the 'hidden' class instead of using style.display
                    expandedItems.classList.toggle('hidden');

                    // Update button text and icon
                    const isExpanded = !expandedItems.classList.contains('hidden');
                    expandText.textContent = isExpanded ? 'Thu gọn' : 'Xem thêm môn học';
                    expandIcon.style.transform = isExpanded ? 'rotate(180deg)' : 'rotate(0deg)';

                    // Smooth scroll if expanding
                    if (isExpanded) {
                        expandedItems.scrollIntoView({behavior: 'smooth', block: 'start'});
                    }
                });
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Date validation
            const ngayBatDau = document.getElementById('ngay_bat_dau');
            const ngayKetThuc = document.getElementById('ngay_ket_thuc');

            if (ngayBatDau && ngayKetThuc) {
                ngayBatDau.addEventListener('change', function() {
                    ngayKetThuc.min = this.value;
                });
            }

            // Search function
            const searchButton = document.querySelector('.button');
            if (searchButton) {
                searchButton.addEventListener('click', function() {
                    const searchData = {
                        hocky: document.getElementById('hocky').value,
                        ngay_bat_dau: ngayBatDau.value,
                        ngay_ket_thuc: ngayKetThuc.value,
                        so_sinh_vien: '{{ $soSinhVien }}' // Using the value from controller
                    };

                    console.log('Search Data:', searchData);
                    // Add your search logic here
                });
            }
        });

        // Optional: Format số sinh viên display
        const soSinhVienElement = document.getElementById('so_sinh_vien');
        if (soSinhVienElement) {
            soSinhVienElement.textContent = `{{ $soSinhVien }} sinh viên`;
        }
    </script>
@endsection
