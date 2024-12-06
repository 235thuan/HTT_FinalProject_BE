@extends('thuan.layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form method="POST" action="{{ url('/auth/login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="ten_dang_nhap" class="form-label">Username</label>
                        <input type="text" class="form-control" id="ten_dang_nhap" name="ten_dang_nhap" required>
                    </div>
                    <div class="mb-3">
                        <label for="mat_khau" class="form-label">Password</label>
                        <input type="password" class="form-control" id="mat_khau" name="mat_khau" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 