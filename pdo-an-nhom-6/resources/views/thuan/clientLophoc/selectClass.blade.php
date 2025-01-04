@extends('thuan.layouts.app')

@section('content')
    <div class="outer-container">
        <div class="class-selection-container">
            <div class="sidebar">
                <div class="sidebar-item active">Danh sách lớp học</div>
                <div class="sidebar-item">Thông tin khoa</div>
            </div>

            <div class="main-content">
                <div class="classes-grid">
                    @foreach($teacherClasses as $lop)

                        <div class="class-card">
                            <div class="class-image">
                                <img src="https://images.unsplash.com/photo-1578593139939-cccb1e98698c"
                                     alt="{{ $lop->ten_lop }}"/>
                                <span class="student-count">{{ $lop->so_luong_sv }} SV</span>
                            </div>
                            <div class="class-info">
                                <h3>{{ $lop->ten_lop }}</h3>
                                <p>{{ $lop->ten_chuyennganh }}</p>
                                <a href="{{ route('client.lophoc', ['id_lop' => $lop->id_lop]) }}"
                                   class="view-class-btn">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <style>
        .outer-container {
            display: flex;
            justify-content: center;
            align-items: center;
            align-content: center;
            justify-items: center;
            min-height: 100vh;
            padding: 20px;
            background: #f5f5f5;
            margin-left: 20px;
            min-width: 950px;
        }

        .class-selection-container {
            display: flex;

            width: 100%;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            width: 250px;
            background: #fff;
            padding: 20px 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar-item {
            padding: 15px 25px;
            cursor: pointer;
            color: #666;
            transition: all 0.3s ease;
        }

        .sidebar-item.active {
            background: #0b83ff;
            color: white;
        }

        .main-content {
            flex: 1;
            padding: 30px;
        }

        .classes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }

        .class-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .class-card:hover {
            transform: translateY(-5px);
        }

        .class-image {
            position: relative;
            height: 160px;
            overflow: hidden;
        }

        .class-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .student-count {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 14px;
        }

        .class-info {
            padding: 20px;
            position: relative;
        }

        .class-info h3 {
            margin: 0 0 10px;
            color: #333;
            font-size: 18px;
        }

        .class-info p {
            color: #666;
            margin: 0;
            font-size: 14px;
        }

        .view-class-btn {
            position: absolute;
            right: 20px;
            bottom: 20px;
            width: 40px;
            height: 40px;
            background: #0b83ff;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .view-class-btn:hover {
            background: #0969d7;
            transform: scale(1.1);
        }

        @media (max-width: 1240px) {
            .class-selection-container {
                max-width: 95%; /* Slightly smaller on medium screens */
            }
        }

        @media (max-width: 768px) {
            .class-selection-container {
                flex-direction: column;
                max-width: 100%; /* Full width on mobile */
                padding: 10px;
            }

            .sidebar {
                width: 100%;
                margin-bottom: 20px;
            }

            .classes-grid {
                grid-template-columns: 1fr;
            }
        }

    </style>
@endsection
