@extends('thuan.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2 class="mb-4">Danh sách chuyên ngành mẫu</h2>
        
        <div class="row">
            @foreach($chuyenNganhs as $cn)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $cn->ten_chuyennganh }}</h5>
                            <p class="card-text">Khoa: {{ $cn->ten_khoa }}</p>
                            <form action="{{ route('hoa.hocphi.add', $cn->id_chuyennganh) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    Thêm vào giỏ hàng
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection 