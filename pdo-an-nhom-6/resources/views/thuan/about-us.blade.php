@extends('thuan.layouts.app')

@section('content')
    <style>
        .card {
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .text-primary {
            color: #1a73e8 !important;
        }
    </style>
    <style>
        /* General Styles */
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            margin-bottom: 60px;
        }

        .hero-section img {
            transition: transform 0.5s ease;
        }

        .hero-section:hover img {
            transform: scale(1.05);
        }

        /* Cards & Hover Effects */
        .card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 2rem;
        }

        /* Stats Section */
        .stats-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: 15px;
            padding: 2rem;
            height: 100%;
        }

        .stats-card h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(45deg, #1a73e8, #0d47a1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Features Section */
        .feature-card {
            position: relative;
            overflow: hidden;
        }

        .feature-card img {
            transition: transform 0.5s ease;
        }

        .feature-card:hover img {
            transform: scale(1.1);
        }

        .feature-card h4 {
            color: #1a73e8;
            margin-top: 1.5rem;
            font-weight: 600;
        }

        /* Programs Section */
        .program-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        }

        .program-card h5 {
            color: #1a73e8;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .program-card ul li {
            margin-bottom: 0.5rem;
            padding-left: 1.5rem;
            position: relative;
        }

        .program-card ul li::before {
            content: "✓";
            color: #1a73e8;
            position: absolute;
            left: 0;
            font-weight: bold;
        }

        /* Contact Section */
        .contact-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            padding: 3rem;
            border-radius: 15px;
            margin-top: 4rem;
        }

        .contact-section i {
            color: #1a73e8;
            margin-right: 10px;
            font-size: 1.2rem;
        }

        /* Typography */
        h1, h2, h4, h5 {
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        .lead {
            font-size: 1.25rem;
            line-height: 1.8;
            color: #495057;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .stats-card h3 {
                font-size: 2rem;
            }

            .card-body {
                padding: 1.5rem;
            }

            .hero-section {
                margin-bottom: 40px;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #1a73e8;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #0d47a1;
        }

        /* Image Overlay Effects */
        .feature-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(0deg, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0) 50%);
            pointer-events: none;
        }

        /* Additional Utility Classes */
        .shadow-custom {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .text-gradient {
            background: linear-gradient(45deg, #1a73e8, #0d47a1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .border-gradient {
            border: double 4px transparent;
            background-image: linear-gradient(white, white),
            linear-gradient(45deg, #1a73e8, #0d47a1);
            background-origin: border-box;
            background-clip: content-box, border-box;
        }
    </style>


    <div class="container py-5">
        <!-- Hero Section -->
        <div class="row mb-5 hero-section">
            <div class="col-12" style="width: 100%">
                <img src="https://images.unsplash.com/photo-1562774053-701939374585?ixlib=rb-4.0.3"
                     class="img-fluid rounded shadow-custom"
                     alt="University Campus"
                     style="width: 100%; height: 400px; object-fit: cover;">
            </div>
        </div>

        <!-- Introduction -->
        <div class="row mb-5 animate-fade-in">
            <div class="col-12">
                <h1 class="text-gradient mb-4">Đồ án nhóm 6</h1>
                <p class="lead border-gradient p-4">
                    Thành lập từ năm 1975, Đồ án nhóm 6 là một trong những dự án hàng đầu Việt Nam
                    về đào tạo công nghệ thông tin và kỹ thuật.
                </p>
            </div>
        </div>

        <!-- Stats -->
        <div class="row mb-5 text-center">
            <div class="col-md-4 mb-3">
                <div class="stats-card shadow-custom">
                    <h3>20,000+</h3>
                    <p class="mb-0">Sinh viên đang theo học</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="stats-card shadow-custom">
                    <h3>200+</h3>
                    <p class="mb-0">Chương trình đào tạo và liên kết đào tạo</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="stats-card shadow-custom">
                    <h3>500+</h3>
                    <p class="mb-0">Giảng viên có trình độ cao</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="stats-card shadow-custom">
                    <h3>95%</h3>
                    <p class="mb-0">Sinh viên có việc làm sau tốt nghiệp</p>
                </div>
            </div>
        </div>

        <!-- Features -->
        <div class="row mb-5">
            <div class="col-md-6 mb-4">
                <div class="feature-card card h-100 shadow-custom">
                    <img src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?ixlib=rb-4.0.3"
                         class="card-img-top"
                         alt="Modern Facilities"
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h4>Cơ sở vật chất hiện đại</h4>
                        <p>Trường được trang bị đầy đủ phòng thí nghiệm, thư viện điện tử và các thiết bị học tập tiên tiến.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="feature-card card h-100 shadow-custom">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-4.0.3"
                         class="card-img-top"
                         alt="International Cooperation"
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h4>Hợp tác quốc tế</h4>
                        <p>Chương trình trao đổi sinh viên và hợp tác nghiên cứu với nhiều trường đại học trên thế giới.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Programs -->
        <div class="row mb-5 animate-fade-in">
            <div class="col-12">
                <h2 class="text-gradient mb-4">Chương trình đào tạo</h2>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="program-card card shadow-custom">
                            <div class="card-body">
                                <h5>Công nghệ thông tin</h5>
                                <ul class="list-unstyled">
                                    <li>Phát triển phần mềm</li>
                                    <li>An toàn thông tin</li>
                                    <li>Trí tuệ nhân tạo</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="program-card card shadow-custom">
                            <div class="card-body">
                                <h5>Quản trị kinh doanh</h5>
                                <ul class="list-unstyled">
                                    <li>Marketing số</li>
                                    <li>Quản trị nhân sự</li>
                                    <li>Tài chính - Ngân hàng</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="program-card card shadow-custom">
                            <div class="card-body">
                                <h5>Kỹ thuật</h5>
                                <ul class="list-unstyled">
                                    <li>Cơ khí</li>
                                    <li>Điện - Điện tử</li>
                                    <li>Xây dựng</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact -->
        <div class="contact-section animate-fade-in">
            <div class="col-12 text-center">
                <h2 class="text-gradient mb-4">Liên hệ</h2>
                <p><i class="fas fa-map-marker-alt"></i> 123 Đường ABC, Quận XYZ, TP.Hà Nội</p>
                <p><i class="fas fa-phone"></i> (084) 1234 56789</p>
                <p><i class="fas fa-envelope"></i> info@nhom6.edu.vn</p>
            </div>
        </div>
    </div>
@endsection




