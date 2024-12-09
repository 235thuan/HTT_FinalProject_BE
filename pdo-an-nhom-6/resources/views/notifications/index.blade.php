@extends('layouts.vertical', ['title' => 'Thông báo'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Thông báo</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @forelse($notifications as $notification)
                        <div class="d-flex mb-4 pb-2 border-bottom notification-item {{ $notification->da_doc ? '' : 'bg-light' }}">
                            <div class="flex-shrink-0">
                                <img src="{{ $notification->nguoiDung->avatar_url }}" 
                                     class="rounded-circle avatar-sm" 
                                     alt="user-pic">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-1">{{ $notification->tieu_de }}</h6>
                                    @if(!$notification->da_doc)
                                        <span class="badge bg-danger ms-2">Mới</span>
                                    @endif
                                </div>
                                <div class="text-muted">
                                    <p class="mb-1">{{ $notification->noi_dung }}</p>
                                    <p class="mb-0">
                                        <small>{{ $notification->thoi_gian->diffForHumans() }}</small>
                                        @if($notification->da_doc)
                                            <span class="text-muted ms-2">(Đã đọc)</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center p-4">
                            <p class="text-muted">Không có thông báo nào</p>
                        </div>
                    @endforelse

                    <div class="d-flex justify-content-center mt-3">
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 