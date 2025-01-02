@extends('thuan.layouts.app')


@section('css')

    <link rel="stylesheet" href="{{ asset('css/vuong/subject-detail.css') }}">
<link rel="stylesheet" href="../styles/subject.css"/>

<link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        rel="stylesheet"
/>

@endsection
<style>
    .main-content{
        display: flex;
        max-width: 1200px;
        padding-left: 20px;
        padding-right: 20px;
    }
</style>
<style>
    .page-wrapper {
        background-color: whitesmoke;
        padding-top: 20px;
        padding-bottom: 20px;
        display: flex;
        width: 100%;
        gap: 20px; /* Space between sidebar and content */
    }

    .sidebar {
        width: 250px; /* Or your preferred width */
        flex-shrink: 0; /* Prevents sidebar from shrinking */
    }

    .tab-contents {
        flex: 1; /* Takes up remaining space */
        min-width: 0; /* Prevents flex item from overflowing */
        display: flex;
        flex-direction: column;
    }

    .tab-panel {
        display: none;
        width: 100%;
    }

    .tab-panel.active {
        display: flex;
        gap: 20px; /* Space between main content and aside */
    }

    .body-main-content {
        flex: 1; /* Takes up available space */
        min-width: 500px; /* Prevents overflow */
    }

    .aside-main-content {
        width: 300px; /* Or your preferred width */
        flex-shrink: 0; /* Prevents shrinking */
    }

</style>
<style>


    .head-subjects-container h2 {
        font-size: 24px;
        margin: 0;
        color: #333;
    }

    .head-subjects-container span {
        display: block;
        font-size: 14px;
        color: #666;
        margin-top: 5px;
    }

    .subjects-grid {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        padding: 1rem;
    }

    /* Make subject cards full width */
    .subject-card {
        display: flex;
        align-items: center;
        width: 800px;
        padding: 1rem;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .subject-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .subject-image {
        width: 100px;
        height: 100px;
        margin-right: 1.5rem;
        flex-shrink: 0;
    }

    .subject-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
    }

    .subject-info {
        flex-grow: 1;
    }

    .subject-info h3 {
        margin: 0 0 0.5rem 0;
        font-size: 1.2rem;
        color: #333;
    }

    .subject-info p {
        margin: 0;
        color: #666;
    }

    .subject-link {
        margin-left: auto;
        padding: 0.5rem;
        color: #007bff;
        transition: color 0.2s ease;
    }

    .subject-link:hover {
        color: #0056b3;
    }

    .fa-arrow-right {
        font-size: 16px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .subjects-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }

        .head-subjects-container {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .subject-image {
            height: 140px;
        }
    }
</style>

<style>
    .lessons-grid {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .lesson-card {
        display: flex;
        width: 800px;
        align-items: center;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        padding: 15px;
        transition: transform 0.3s;
    }

    .lesson-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .lesson-info {
        flex: 1;
    }

    .lesson-info h3 {
        margin: 0 0 5px 0;
        font-size: 18px;
        color: #333;
    }

    .lesson-info p {
        margin: 0;
        color: #666;
        font-size: 14px;
    }

    .lesson-link {
        padding: 10px;
        color: #007bff;
        text-decoration: none;
    }

    .lesson-link:hover {
        color: #0056b3;
    }
</style>

<style>
    .student-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .student-list, .student-list-expanded {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .student-list li, .student-list-expanded li {
        display: flex;
        align-items: center;
        padding: 0.5rem 0;
    }

    .student-image {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 1rem;
        object-fit: cover;
    }

    .view-all-btn {
        padding: 0.5rem 1rem;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .view-all-btn:hover {
        background: #0056b3;
    }

    .student-list-expanded {
        margin-top: 1rem;
        border-top: 1px solid #eee;
        padding-top: 1rem;
    }
</style>

<style>
.current-user {
    background-color: rgba(0, 123, 255, 0.1);
    border-radius: 4px;
}

.current-user-badge {
    font-size: 0.8em;
    color: #007bff;
    margin-left: 0.5rem;
}
</style>

@section('content')

    <main class="main-content">
        <div class="page-wrapper">
            <div class="sidebar">
                <div class="sidebar-item" data-tab="subjects-list">Danh sách môn học</div>
                <div class="sidebar-item" data-tab="lessons-list">Danh sách bài học</div>
                <div class="sidebar-item active" data-tab="current-lesson">Bài học</div>
            </div>
            <div class="tab-contents">

                <div class="tab-panel active" id="subjects-list">
                    <div class="subjects-grid">
                        @foreach($subjects as $subject)
                            <div class="subject-card">
                                <div class="subject-image">
                                    <img src="{{ asset($subject->image_url) }}" alt="{{ $subject->ten_monhoc }}" />
                                </div>
                                <div class="subject-info">
                                    <h3>{{ $subject->ten_monhoc }}</h3>
                                    <p>{{ $subject->so_tin_chi }} tín chỉ</p>
                                </div>
                                <a href="javascript:void(0)"
                                   onclick="showLessons({{ $subject->id_monhoc }})"
                                   class="subject-link">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-panel" id="lessons-list">
                    <div class="lessons-grid"></div>
                </div>

                <div class="tab-panel" id="current-lesson">
                    <div class="body-main-content">
                        <div class="subjects-detail-container">
                            <div class="video-container">
                                <iframe
                                    width="560"
                                    height="315"
                                    src="https://www.youtube.com/embed/VIDEO_ID_HERE"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                ></iframe>
                            </div>
                            <div class="content-container">
                                <h2>Video, bài tập, nội dung môn học ...</h2>
                                <p>
                                    In this lesson, we will dive deeper into the topic of risk
                                    management, exploring the various strategies and techniques used
                                    to identify, analyze, and mitigate risks in different scenarios.
                                </p>
                                <h3>Tài liệu</h2>
                                    <ul>
                                        <li>Lesson Focus: Identifying Constraints and Assumptions</li>
                                        <li>Lesson Focus: Scope Verification and Validation</li>
                                    </ul>
                            </div>
                        </div>
                    </div>
                    <div class="aside-main-content">
                        <div class="head-aside">
                            <div class="student-header">
                                <h3>Danh sách sinh viên {{ $currentStudent->lop->ten_lop ?? '' }}</h3>
                                @if($allStudents->count() > 3)
                                    <button class="view-all-btn" onclick="toggleStudentList()">Xem tất cả</button>
                                @endif
                            </div>
                            <ul class="student-list">
                                @if($allStudents->count() > 0)
                                    @foreach($allStudents->take(3) as $student)
                                        <li class="{{ $student->id_nguoidung === Auth::user()->id_nguoidung ? 'current-user' : '' }}">
                                            <img
                                                src="{{ $student->avatar_url }}"
                                                alt="{{ $student->ten_sinhvien }}"
                                                class="student-image"
                                            />
                                            <span class="student-name">
                                                {{ $student->ten_sinhvien }}
                                                @if($student->id_nguoidung === Auth::user()->id_nguoidung)
                                                    <span class="current-user-badge">(Bạn)</span>
                                                @endif
                                            </span>
                                        </li>
                                    @endforeach
                                @else
                                    <li>Không có sinh viên nào trong lớp</li>
                                @endif
                            </ul>
                            
                            @if($allStudents->count() > 3)
                                <ul class="student-list-expanded" style="display: none;">
                                    @foreach($allStudents->slice(3) as $student)
                                        <li class="{{ $student->id_nguoidung === Auth::user()->id_nguoidung ? 'current-user' : '' }}">
                                            <img
                                                src="{{ $student->avatar_url }}"
                                                alt="{{ $student->ten_sinhvien }}"
                                                class="student-image"
                                            />
                                            <span class="student-name">
                                                {{ $student->ten_sinhvien }}
                                                @if($student->id_nguoidung === Auth::user()->id_nguoidung)
                                                    <span class="current-user-badge">(Bạn)</span>
                                                @endif
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <div class="bottom-aside">
                            <h2>Chat</h2>
                            <div class="chat-container">
                                <div class="chat-header">
                                    <span>Tham gia thảo luận với bạn học</span>
                                    <button class="open-chat-btn">Mở chat</button>
                                </div>
                                <div class="chat-messages"></div>
                                <div class="chat-input">
                                    <input type="text" placeholder="Nhập tin nhắn..." />
                                    <button class="send-message-btn">Gửi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('js/vuong/script.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarItems = document.querySelectorAll('.sidebar-item');

            sidebarItems.forEach(item => {
                item.addEventListener('click', () => {
                    const targetPanel = item.getAttribute('data-tab');
                    activatePanel(targetPanel);
                });
            });
        });

        function activatePanel(panelId) {
            document.querySelectorAll('.sidebar-item').forEach(item => {
                item.classList.remove('active');
            });
            document.querySelectorAll('.tab-panel').forEach(panel => {
                panel.classList.remove('active');
            });

            document.querySelector(`.sidebar-item[data-tab="${panelId}"]`).classList.add('active');
            document.getElementById(panelId).classList.add('active');
        }

        function showLessons(id_monhoc) {
            fetch(`/client/lessons/${id_monhoc}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const lessonsGrid = document.querySelector('.lessons-grid');
                        if (data.data.length > 0) {
                            lessonsGrid.innerHTML = data.data.map(lesson => `
                                <div class="lesson-card">
                                    <div class="lesson-info">
                                        <h3>${lesson.ten_bai_giang}</h3>
                                        <p>${lesson.thoi_luong ? Math.floor(lesson.thoi_luong / 60) + ' phút' : ''}</p>
                                    </div>
                                    <a href="javascript:void(0)"
                                       onclick="showLesson(${lesson.id_noidung}, '${lesson.ten_bai_giang}', '${lesson.duong_dan}')"
                                       class="lesson-link">
                                        <i class="fa-solid fa-play"></i>
                                    </a>
                                </div>
                            `).join('');
                        } else {
                            lessonsGrid.innerHTML = `
                                <div class="no-lessons">
                                    <p>Chưa có bài học nào cho môn học này.</p>
                                </div>
                            `;
                        }
                        activatePanel('lessons-list');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi tải danh sách bài học');
                });
        }

        function showLesson(id_noidung, ten_bai_giang, duong_dan) {
            // First, activate the current-lesson panel
            activatePanel('current-lesson');

            // Update the current lesson content immediately with available data
            const videoContainer = document.querySelector('.video-container iframe');
            const titleElement = document.querySelector('.content-container h2');
            const descriptionElement = document.querySelector('.content-container p');

            // Set video source
            if (duong_dan) {
                videoContainer.src = duong_dan.includes('youtube.com')
                    ? duong_dan
                    : `https://www.youtube.com/embed/${duong_dan}`;
            } else {
                videoContainer.src = '';
            }

            // Set title
            titleElement.textContent = ten_bai_giang || 'Đang tải...';
            descriptionElement.textContent = 'Đang tải...';

            // Then fetch additional details from baihoc
            fetch(`/client/lesson/${id_noidung}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.data.lesson) {
                        const lesson = data.data.lesson;

                        // Update description and any additional content
                        descriptionElement.textContent = lesson.mo_ta || 'Không có mô tả';

                        // Update any additional lesson details here
                        if (lesson.materials) {
                            const materialsList = document.querySelector('.materials-list');
                            if (materialsList) {
                                materialsList.innerHTML = lesson.materials.map(material =>
                                    `<li>${material}</li>`
                                ).join('');
                            }
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    descriptionElement.textContent = 'Có lỗi xảy ra khi tải chi tiết bài học';
                });
        }

        function backToSubjects() {
            activatePanel('subjects-list');
        }

        function toggleStudentList() {
            const expandedList = document.querySelector('.student-list-expanded');
            const viewAllBtn = document.querySelector('.view-all-btn');
            
            if (expandedList.style.display === 'none') {
                expandedList.style.display = 'block';
                viewAllBtn.textContent = 'Thu gọn';
            } else {
                expandedList.style.display = 'none';
                viewAllBtn.textContent = 'Xem tất cả';
            }
        }
    </script>
@endsection

