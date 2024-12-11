<!-- Topbar Start -->
<div class="topbar-custom">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                <li>
                    <button class="button-toggle-menu nav-link">
                        <i data-feather="menu" class="noti-icon"></i>
                    </button>
                </li>
                <li class="d-none d-lg-block">
                    @if(request()->routeIs('qlnd.listSinhvien'))
                        <div class="position-relative topbar-search">
                            <input type="text" 
                                   id="student-search" 
                                   class="form-control bg-light bg-opacity-75 border-light ps-4"
                                   placeholder="Tìm kiếm sinh viên...">
                            <i class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2 search-icon"></i>
                            
                            <!-- Suggestions dropdown -->
                            <div id="student-search-suggestions" class="suggestions-dropdown" style="display: none;">
                                <div class="suggestions-list"></div>
                                <div class="no-results" style="display: none;">
                                    <p class="text-muted p-2 mb-0">Không tìm thấy kết quả</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(request()->routeIs('qlnd.listGiaovien'))
                        <div class="position-relative topbar-search">
                            <input type="text" 
                                   id="teacher-search" 
                                   class="form-control bg-light bg-opacity-75 border-light ps-4"
                                   placeholder="Tìm kiếm giáo viên..." 
                                   value="{{ request('search') }}">
                            <i class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2 search-icon"></i>
                            
                            <!-- Suggestions dropdown -->
                            <div id="teacher-search-suggestions" class="suggestions-dropdown" style="display: none;">
                                <div class="suggestions-list"></div>
                                <div class="no-results" style="display: none;">
                                    <p class="text-muted p-2 mb-0">Không tìm thấy kết quả</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </li>
            </ul>
            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">

                <li class="d-none d-sm-flex">
                    <button type="button" class="btn nav-link" data-toggle="fullscreen">
                        <i data-feather="maximize" class="align-middle fullscreen noti-icon"></i>
                    </button>
                </li>

                <li class="dropdown notification-list">
                    <div class="dropdown">
                        <button class="btn nav-link dropdown-toggle" type="button">
                            <i data-feather="bell" class="noti-icon"></i>
                            @if($unreadCount = auth()->user()->unreadNotifications->count())
                                <span class="badge bg-danger rounded-circle noti-icon-badge">{{ $unreadCount }}</span>
                            @endif
                        </button>
                        <div class="dropdown-menu dropdown-menu-end dropdown-lg">
                            <div class="dropdown-item noti-title">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="m-0">Thông báo</h5>
                                    <div>
                                        <a href="javascript:void(0);" onclick="markAllAsRead()" class="text-dark">
                                            <small>Đánh dấu đã đọc</small>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="noti-scroll" data-simplebar>
                                <div id="unread-notifications">
                                    @forelse(auth()->user()->recentNotifications()->where('da_doc', 0)->get() as $notification)
                                        <a href="javascript:void(0);" 
                                           class="dropdown-item notify-item" 
                                           onclick="markAsRead({{ $notification->id_thongbao }})">
                                            <div class="notify-icon">
                                                @if($notification->nguoiDung && $notification->nguoiDung->avatar_url)
                                                    <img src="{{ $notification->nguoiDung->avatar_url }}" 
                                                         class="img-fluid rounded-circle" 
                                                         alt="" />
                                                @else
                                                    <i class="mdi mdi-bell-outline"></i>
                                                @endif
                                            </div>
                                            <div class="notify-content">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <p class="notify-details mb-0">
                                                        {{ $notification->tieu_de }}
                                                        <span class="badge bg-danger ms-1">Mới</span>
                                                    </p>
                                                    <small class="text-muted">{{ $notification->thoi_gian->diffForHumans() }}</small>
                                                </div>
                                                <p class="text-muted mb-0 mt-1">{{ Str::limit($notification->noi_dung, 50) }}</p>
                                            </div>
                                        </a>
                                    @empty
                                        <div class="text-center p-2">
                                            <p class="text-muted">Không có thông báo mới</p>
                                        </div>
                                    @endforelse
                                </div>
                                
                                <div id="all-notifications" style="display: none;">
                                    @forelse(auth()->user()->recentNotifications()->get() as $notification)
                                        <a href="javascript:void(0);" 
                                           class="dropdown-item notify-item {{ $notification->da_doc ? '' : 'bg-light' }}" 
                                           onclick="markAsRead({{ $notification->id_thongbao }})">
                                            <div class="notify-icon">
                                                <img src="{{ $notification->nguoiDung->avatar_url }}" 
                                                     class="img-fluid rounded-circle" 
                                                     alt="" />
                                            </div>
                                            <div class="notify-content">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <p class="notify-details">
                                                        {{ $notification->tieu_de }}
                                                        @if(!$notification->da_doc)
                                                            <span class="badge bg-danger ms-1">Mới</span>
                                                        @endif
                                                    </p>
                                                    <small class="text-muted">{{ $notification->thoi_gian->diffForHumans() }}</small>
                                                </div>
                                                <p class="text-muted mb-0">{{ Str::limit($notification->noi_dung, 50) }}</p>
                                            </div>
                                        </a>
                                    @empty
                                        <div class="text-center p-2">
                                            <p class="text-muted">Không có thông báo</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="dropdown-item text-center border-top py-2">
                                <a href="javascript:void(0);" onclick="toggleNotifications()" class="text-primary text-decoration-none">
                                    <small id="toggle-text">Xem tất cả</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="dropdown notification-list">
                    <div class="dropdown">
                        <button class="btn nav-link dropdown-toggle" type="button">
                            <img src="{{ auth()->user()->avatar_url }}" alt="user-image" class="rounded-circle">
                            <span class="pro-user-name ms-1">
                                {{ auth()->user()->ten_dang_nhap }} <i class="mdi mdi-chevron-down"></i>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Xin chào!</h6>
                            </div>

                            <!-- item-->
                            <a href="{{ route('second', ['utility', 'profile']) }}" class="dropdown-item notify-item">
                                <i class="mdi mdi-account-circle-outline fs-16 align-middle"></i>
                                <span>Tài khoản của tôi</span>
                            </a>

                            <!-- item-->
                            <a href="{{ route('second', ['auth', 'lockscreen']) }}" class="dropdown-item notify-item">
                                <i class="mdi mdi-lock-outline fs-16 align-middle"></i>
                                <span>Khóa màn hình</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle">Đăng xuất</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </li>

            </ul>
        </div>

    </div>

</div>
<!-- end Topbar -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let viewState = 'unread'; // 'unread', 'all', 'read'

function toggleNotifications() {
    const unreadSection = document.getElementById('unread-notifications');
    const allSection = document.getElementById('all-notifications');
    const toggleText = document.getElementById('toggle-text');
    
    if (!unreadSection || !allSection || !toggleText) {
        console.error('Required elements not found');
        return;
    }

    if (viewState === 'unread') {
        viewState = 'all';
        unreadSection.style.display = 'none';
        allSection.style.display = 'block';
        toggleText.textContent = 'Thu gọn';
    } else {
        viewState = 'unread';
        unreadSection.style.display = 'block';
        allSection.style.display = 'none';
        toggleText.textContent = 'Xem tất cả';
    }
}

function markAllAsRead() {
    fetch('/notifications/mark-all-read', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove all notifications from unread view
            const unreadSection = document.getElementById('unread-notifications');
            if (unreadSection) {
                unreadSection.innerHTML = `
                    <div class="text-center p-2">
                        <p class="text-muted">Không có thông báo mới</p>
                    </div>
                `;
            }
            
            // Hide the notification badge
            const badge = document.querySelector('.noti-icon-badge');
            if (badge) {
                badge.style.display = 'none';
            }
            
            // Show empty state
            document.querySelector('.noti-scroll').innerHTML = `
                <div class="text-center p-2">
                    <p class="text-muted">Không có thông báo mới</p>
                </div>
            `;
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Add search functionality when on student list page
@if(request()->routeIs('qlnd.listSinhvien'))
$(document).ready(function() {
    var searchTimeout;
    var currentSearchTerm = '';
    
    $('#student-search').on('keyup', function(e) {
        var searchBox = $(this);
        var suggestionsBox = $('#student-search-suggestions');
        var searchTerm = searchBox.val().trim();
        currentSearchTerm = searchTerm;
        
        clearTimeout(searchTimeout);
        
        if (searchTerm.length < 2) {
            suggestionsBox.hide();
            return;
        }
        
        // Handle enter key
        if (e.key === 'Enter') {
            performSearch(searchTerm);
            return;
        }
        
        // Get suggestions
        searchTimeout = setTimeout(function() {
            $.ajax({
                url: '{{ route("qlnd.searchSinhvien") }}',
                data: { 
                    search: searchTerm,
                    suggest: true
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                error: function(xhr, status, error) {
                    console.error('Search error:', error);
                    toastr.error('Có lỗi xảy ra khi tìm kiếm');
                },
                success: function(response) {
                    if (searchTerm !== currentSearchTerm) return;
                    
                    var suggestionsList = suggestionsBox.find('.suggestions-list');
                    suggestionsList.empty();
                    
                    if (response.suggestions && response.suggestions.length > 0) {
                        // Add category headers
                        var classHeader = false;
                        var studentHeader = false;
                        
                        response.suggestions.forEach(function(item) {
                            if (item.type === 'class' && !classHeader) {
                                suggestionsList.append('<div class="suggestion-header">Lớp/Khoa/Chuyên ngành</div>');
                                classHeader = true;
                            } else if (item.type === 'student' && !studentHeader) {
                                suggestionsList.append('<div class="suggestion-header">Sinh viên</div>');
                                studentHeader = true;
                            }
                            
                            var html = '';
                            if (item.type === 'class') {
                                html = `
                                    <div class="suggestion-item" 
                                         data-type="class" 
                                         data-lop="${item.ten_lop}">
                                        <div class="d-flex justify-content-between">
                                            <span>${highlightMatch(item.ten_lop, searchTerm)}</span>
                                            <small class="text-muted">${item.student_count} sinh viên</small>
                                        </div>
                                        <small class="text-muted">
                                            ${highlightMatch(item.ten_chuyennganh, searchTerm)} - 
                                            ${highlightMatch(item.ten_khoa, searchTerm)}
                                        </small>
                                    </div>
                                `;
                            } else {
                                html = `
                                    <div class="suggestion-item" 
                                         data-type="student"
                                         data-id="${item.id_sinhvien}"
                                         data-lop="${item.lop}">
                                        <div class="d-flex justify-content-between">
                                            <span>${highlightMatch(item.ten_sinhvien, searchTerm)}</span>
                                            <small class="text-muted">${item.lop}</small>
                                        </div>
                                        <small class="text-muted">${item.email}</small>
                                    </div>
                                `;
                            }
                            suggestionsList.append(html);
                        });
                        
                        suggestionsBox.find('.suggestions-list').show();
                        suggestionsBox.find('.no-results').hide();
                    } else {
                        suggestionsBox.find('.suggestions-list').hide();
                        suggestionsBox.find('.no-results').show();
                    }
                    
                    suggestionsBox.show();
                }
            });
        }, 300);
    });
    
    // Handle suggestion click
    $(document).on('click', '.suggestion-item', function() {
        var type = $(this).data('type');
        if (type === 'student') {
            var id = $(this).data('id');
            var lop = $(this).data('lop');
            scrollToStudent(id, lop);
        } else {
            var lop = $(this).data('lop');
            scrollToClass(lop);
        }
        $('#student-search-suggestions').hide();
    });
    
    // Handle search icon click
    $(document).on('click', '.search-icon', function() {
        var searchTerm = $('#student-search').val().trim();
        if (searchTerm.length >= 2) {
            performSearch(searchTerm);
        }
    });
    
    // Close suggestions on click outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.topbar-search').length) {
            $('.suggestions-dropdown').hide();
        }
    });
    
    function performSearch(term) {
        $.ajax({
            url: '{{ route("qlnd.searchSinhvien") }}',
            data: { search: term },
            success: function(response) {
                if (response.found) {
                    if (response.type === 'class') {
                        scrollToClass(response.class.ten_lop);
                    } else if (response.type === 'student') {
                        scrollToStudent(response.student.id_sinhvien, response.student.lop);
                    }
                } else {
                    // Show not found message
                    toastr.info('Không tìm thấy kết quả phù hợp');
                }
            }
        });
    }
    
    function scrollToStudent(id, lop) {
        var studentRow = $(`tr[data-student-id="${id}"]`);
        if (studentRow.length) {
            // Student is visible on current page
            $('html, body').animate({
                scrollTop: studentRow.offset().top - 100
            }, 500);
            studentRow.addClass('highlight-row');
            setTimeout(() => studentRow.removeClass('highlight-row'), 3000);
        } else {
            // Student might be on another page, reload with search parameters
            var currentUrl = new URL(window.location.href);
            var params = new URLSearchParams(currentUrl.search);
            
            // Keep existing pagination parameters
            var paginationParams = {};
            for (var pair of params.entries()) {
                if (pair[0].startsWith('page_')) {
                    paginationParams[pair[0]] = pair[1];
                }
            }
            
            // Build new URL with both find parameters and pagination
            var newUrl = window.location.pathname + '?find_student=' + id + 
                '&find_lop=' + encodeURIComponent(lop);
            
            // Add pagination parameters
            for (var key in paginationParams) {
                newUrl += '&' + key + '=' + paginationParams[key];
            }
            
            window.location.href = newUrl;
        }
    }
    
    function scrollToClass(lop) {
        // Find the card with the class name in its header
        var classCard = $(`h5:contains("${lop}")`).closest('.card');
        if (classCard.length) {
            // Class is visible
            $('html, body').animate({
                scrollTop: classCard.offset().top - 100
            }, 500);
            classCard.addClass('highlight-card');
            setTimeout(() => classCard.removeClass('highlight-card'), 3000);
        } else {
            // Class might be on another page or needs to be loaded
            window.location.href = window.location.pathname + 
                '?search_lop=' + encodeURIComponent(lop);
        }
    }
    
    function highlightMatch(text, term) {
        if (!term) return text;
        var regex = new RegExp(`(${term})`, 'gi');
        return text.replace(regex, '<span class="highlight">$1</span>');
    }
});
@endif

@if(request()->routeIs('qlnd.listGiaovien'))
$(document).ready(function() {
    var searchTimeout;
    var currentSearchTerm = '';
    
    $('#teacher-search').on('keyup', function(e) {
        var searchBox = $(this);
        var suggestionsBox = $('#teacher-search-suggestions');
        var searchTerm = searchBox.val().trim();
        currentSearchTerm = searchTerm;
        
        clearTimeout(searchTimeout);
        
        if (searchTerm.length < 2) {
            suggestionsBox.hide();
            return;
        }
        
        // Handle enter key
        if (e.key === 'Enter') {
            performTeacherSearch(searchTerm);
            return;
        }
        
        // Get suggestions
        searchTimeout = setTimeout(function() {
            $.ajax({
                url: '{{ route("qlnd.searchGiaovien") }}',
                data: { 
                    search: searchTerm,
                    suggest: true
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (searchTerm !== currentSearchTerm) return;
                    
                    var suggestionsList = suggestionsBox.find('.suggestions-list');
                    suggestionsList.empty();
                    
                    if (response.suggestions && response.suggestions.length > 0) {
                        // Add category headers
                        var departmentHeader = false;
                        var teacherHeader = false;
                        
                        response.suggestions.forEach(function(item) {
                            if (item.type === 'department' && !departmentHeader) {
                                suggestionsList.append('<div class="suggestion-header">Khoa</div>');
                                departmentHeader = true;
                            } else if (item.type === 'teacher' && !teacherHeader) {
                                suggestionsList.append('<div class="suggestion-header">Giáo viên</div>');
                                teacherHeader = true;
                            }
                            
                            var html = '';
                            if (item.type === 'department') {
                                html = `
                                    <div class="suggestion-item" 
                                         data-type="department" 
                                         data-khoa="${item.ma_khoa}">
                                        <div class="d-flex justify-content-between">
                                            <span>${highlightMatch(item.ten_khoa, searchTerm)}</span>
                                            <small class="text-muted">${item.teacher_count} giáo viên</small>
                                        </div>
                                    
                                    </div>
                                `;
                            } else {
                                html = `
                                    <div class="suggestion-item" 
                                         data-type="teacher"
                                         data-id="${item.id_giaovien}">
                                        <div class="d-flex justify-content-between">
                                            <span>${highlightMatch(item.ten_giaovien, searchTerm)}</span>
                                            <small class="text-muted">${item.ten_khoa}</small>
                                        </div>
                                        <small class="text-muted">${item.email}</small>
                                    </div>
                                `;
                            }
                            suggestionsList.append(html);
                        });
                        
                        suggestionsBox.find('.suggestions-list').show();
                        suggestionsBox.find('.no-results').hide();
                    } else {
                        suggestionsBox.find('.suggestions-list').hide();
                        suggestionsBox.find('.no-results').show();
                    }
                    
                    suggestionsBox.show();
                }
            });
        }, 300);
    });
    
    // Handle suggestion click
    $(document).on('click', '.suggestion-item', function() {
        var type = $(this).data('type');
        if (type === 'teacher') {
            var id = $(this).data('id');
            scrollToTeacher(id);
        } else {
            var khoa = $(this).data('khoa');
            filterByDepartment(khoa);
        }
        $('#teacher-search-suggestions').hide();
    });
    
    function performTeacherSearch(term) {
        $.ajax({
            url: '{{ route("qlnd.searchGiaovien") }}',
            data: { search: term },
            success: function(response) {
                if (response.found) {
                    if (response.type === 'teacher') {
                        scrollToTeacher(response.teacher.id_giaovien);
                    }
                } else {
                    toastr.info('Không tìm thấy kết quả phù hợp');
                }
            }
        });
    }
    
    function scrollToTeacher(id) {
        var teacherRow = $(`tr[data-id="${id}"]`);
        if (teacherRow.length) {
            // Teacher is visible on current page
            $('html, body').animate({
                scrollTop: teacherRow.offset().top - 100
            }, 500);
            teacherRow.addClass('highlight-row');
            setTimeout(() => teacherRow.removeClass('highlight-row'), 3000);
        } else {
            // Teacher might be on another page, reload with search parameters
            window.location.href = window.location.pathname + '?find_teacher=' + id;
        }
    }
  
    
    function filterByDepartment(khoaId) {
        window.location.href = window.location.pathname + '?khoa=' + khoaId;
    }
    function highlightMatch(text, term) {
        if (!term) return text;
        var regex = new RegExp(`(${term})`, 'gi');
        return text.replace(regex, '<span class="highlight">$1</span>');
    }
});
@endif
</script>

<style>
/* Add search-related styles */
.suggestions-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    z-index: 1000;
    max-height: 300px;
    overflow-y: auto;
}
.suggestion-item {
    padding: 8px 12px;
    cursor: pointer;
    border-bottom: 1px solid #eee;
}
.suggestion-item:hover {
    background: #f8f9fa;
}
.suggestion-item .highlight {
    background: yellow;
    font-weight: bold;
}

/* Add to existing search-related styles */
.suggestion-header {
    padding: 4px 12px;
    background: #f8f9fa;
    font-size: 12px;
    color: #6c757d;
    font-weight: 600;
    border-bottom: 1px solid #eee;
}

.highlight-card {
    animation: highlightCard 3s;
}

@keyframes highlightCard {
    0% { box-shadow: 0 0 0 3px #ffc107; }
    100% { box-shadow: none; }
}

/* Add to your existing styles */
.dropdown-menu.dropdown-lg {
    padding: 0;
}

.noti-scroll {
    max-height: 300px;
    overflow-y: auto;
}

.dropdown-item.text-center {
    background: #f8f9fa;
    margin-top: auto;
}

.dropdown-item.text-center:hover {
    background: #e9ecef;
}

.noti-title {
    background: #fff;
    position: sticky;
    top: 0;
    z-index: 1;
    border-bottom: 1px solid #eee;
}

.highlight-row {
    animation: highlightRow 3s;
}

@keyframes highlightRow {
    0% { background-color: #fff3cd; }
    100% { background-color: transparent; }
}
</style>
