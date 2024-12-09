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
                    <div class="position-relative topbar-search">
                        <input type="text" class="form-control bg-light bg-opacity-75 border-light ps-4"
                               placeholder="Tìm kiếm...">
                        <i class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2"></i>
                    </div>
                </li>
            </ul>
            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">

                <li class="d-none d-sm-flex">
                    <button type="button" class="btn nav-link" data-toggle="fullscreen">
                        <i data-feather="maximize" class="align-middle fullscreen noti-icon"></i>
                    </button>
                </li>

                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">
                        <i data-feather="bell" class="noti-icon"></i>
                        @if($unreadCount = auth()->user()->unreadNotifications->count())
                            <span class="badge bg-danger rounded-circle noti-icon-badge">{{ $unreadCount }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-lg">
                        <div class="dropdown-item noti-title">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="m-0">Thông báo</h5>
                                <div>
                                    <a href="javascript:void(0);" onclick="markAllAsRead()" class="text-dark me-2">
                                        <small>Đánh dấu đã đọc</small>
                                    </a>
                                    <a href="javascript:void(0);" onclick="toggleNotifications()" class="text-primary">
                                        <small id="toggle-text">Xem tất cả</small>
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

                            <div id="read-notifications" style="display: none;">
                                @forelse(auth()->user()->recentNotifications()->where('da_doc', 1)->get() as $notification)
                                    <a href="javascript:void(0);" 
                                       class="dropdown-item notify-item" 
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
                                        <p class="text-muted">Không có thông báo đã đọc</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </li>

                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <img src="{{ auth()->user()->avatar_url }}" alt="avt" class="rounded-circle">
                        <span class="pro-user-name ms-1">
                            {{ auth()->user()->ten_dang_nhap }} <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
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
                </li>

            </ul>
        </div>

    </div>

</div>
<!-- end Topbar -->

<script>
let viewState = 'unread'; // 'unread', 'all', 'read'

function toggleNotifications() {
    // Cycle through states
    if (viewState === 'unread') {
        viewState = 'all';
    } else if (viewState === 'all') {
        viewState = 'read';
    } else {
        viewState = 'unread';
    }
    
    // Hide all first
    document.getElementById('unread-notifications').style.display = 'none';
    document.getElementById('all-notifications').style.display = 'none';
    document.getElementById('read-notifications').style.display = 'none';
    
    // Show the selected view
    if (viewState === 'unread') {
        document.getElementById('unread-notifications').style.display = 'block';
        document.getElementById('toggle-text').textContent = 'Xem tất cả';
    } else if (viewState === 'all') {
        document.getElementById('all-notifications').style.display = 'block';
        document.getElementById('toggle-text').textContent = 'Chỉ đã đọc';
    } else {
        document.getElementById('read-notifications').style.display = 'block';
        document.getElementById('toggle-text').textContent = 'Chỉ chưa đọc';
    }
}

function markAllAsRead() {
    fetch('/notifications/mark-all-read', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove all notifications from view
            document.querySelectorAll('.notify-item').forEach(el => el.remove());
            
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
</script>
