@extends('thuan.layouts.app')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
                <form method="POST" action="{{ url('/auth/register/giaovien') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="ten_dang_nhap" class="form-label">Username</label>
                        <input type="text" class="form-control" id="ten_dang_nhap" name="ten_dang_nhap" required>
                    </div>
                    <div class="mb-3">
                        <label for="mat_khau" class="form-label">Password</label>
                        <input type="password" class="form-control" id="mat_khau" name="mat_khau" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="so_dien_thoai" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai">
                    </div>
                    <div class="mb-3">
                        <label for="ten_giaovien" class="form-label">Teacher Name</label>
                        <input type="text" class="form-control" id="ten_giaovien" name="ten_giaovien" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 