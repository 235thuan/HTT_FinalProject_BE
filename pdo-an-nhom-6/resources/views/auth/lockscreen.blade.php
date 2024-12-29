@extends('layouts.auth', ['title' => 'Lock Screen'])

@section('content')
<div class="col-xl-5">
    <div class="row">
        <div class="col-md-7 mx-auto">
            <div class="mb-0 border-0 p-md-5 p-lg-0 p-4">
                <div class="mb-4 p-0">
                    <a href="{{ url('/admin/index') }}" class="auth-logo">
                        <img src="/images/logo-dark.png" alt="logo-dark" class="mx-auto" height="28" />
                    </a>
                </div>

                <div class="text-center mb-4">
                 <img src="{{ auth()->user()->avatar_url ?? '/images/users/avatar-1.jpg' }}" 
         alt="user-image" 
         class="avatar-lg rounded-circle mb-3">
                    <h4 class="text-dark">{{ session('locked_user')['ten_nguoi_dung'] ?? 'User' }}</h4>
                    <p class="text-muted mb-0">
                        <i class="mdi mdi-account me-1"></i>
                        {{ session('locked_user')['ten_dang_nhap'] ?? '' }}
                    </p>
                    @if(!empty(session('locked_user')['email']))
                        <p class="text-muted">
                            <i class="mdi mdi-email me-1"></i>
                            {{ session('locked_user')['email'] }}
                        </p>
                    @endif
                </div>

                <div class="pt-0">
                    <form action="{{ route('unlock') }}" method="POST" class="my-4">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="mdi mdi-lock"></i>
                                </span>
                                <input class="form-control @error('password') is-invalid @enderror" 
                                       type="password" 
                                       id="password" 
                                       name="password"
                                       required 
                                       placeholder="Nhập mật khẩu của bạn">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-0 row">
                            <div class="col-12">
                                <div class="d-grid">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="mdi mdi-lock-open-outline me-1"></i>
                                        Mở khóa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="text-center">
                        <p class="text-muted">
                            Không phải bạn? 
                            <a href="{{ url('/admin/login') }}" class="text-primary fw-bold ms-1">
                                <i class="mdi mdi-login me-1"></i>Đăng nhập
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-7">
    <div class="account-page-bg p-md-5 p-4">
        <div class="text-center">
            <h3 class="text-dark mb-3">Nhanh chóng, Hiệu quả và Năng suất</h3>
            <div class="auth-image">
                <img src="/images/authentication.svg" class="mx-auto img-fluid" alt="images">
            </div>
        </div>
    </div>
</div>
@endsection
