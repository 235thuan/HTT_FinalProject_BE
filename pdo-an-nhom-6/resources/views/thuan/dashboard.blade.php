@extends('thuan.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="card">
    <div class="card-header">Dashboard</div>
    <div class="card-body">
        <h5>Welcome, {{ Auth::user()->ten_dang_nhap }}</h5>
        <p>Your role(s): 
            @foreach(Auth::user()->vaiTro as $role)
                <span class="badge bg-primary">{{ $role->ten_vaitro }}</span>
            @endforeach
        </p>
    </div>
</div>
@endsection 