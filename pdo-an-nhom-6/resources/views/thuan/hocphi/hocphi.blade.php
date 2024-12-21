@extends('thuan.layouts.app')

@section('content')
<div class="payment-container">
    <!-- Cart Column -->
    <div class="cart-column">
        <h2 class="cart-title">Your Cart</h2>
        <div class="cart-items">
            @forelse($cart as $item)
                <div class="cart-item">
                    @if($item['image_url'])
                        <div class="item-image">
                            <img src="{{ asset($item['image_url']) }}" 
                                 alt="{{ $item['ten_chuyennganh'] }}"
                                 onerror="this.src='{{ asset('storage/thuan/default.png') }}'">
                        </div>
                    @endif
                    <div class="item-details">
                        <h3 class="item-title">{{ $item['ten_chuyennganh'] }}</h3>
                        <p class="item-subtitle">{{ $item['ten_khoa'] }}</p>
                        
                        <!-- Show list of subjects -->
                        <div class="subject-list">
                            <h4>Danh sách môn học:</h4>
                            <ul>
                                @foreach($item['monhoc_list'] as $monhoc)
                                    <li>
                                        {{ $monhoc->ten_monhoc }} 
                                        ({{ $monhoc->so_tin_chi }} tín chỉ) - 
                                        {{ number_format($monhoc->price) }} VND
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <span class="item-price">
                            Tổng: {{ number_format($item['price']) }} VND
                        </span>
                        
                        <button onclick="removeFromCart({{ $item['id_chuyennganh'] }})" 
                                class="remove-item">
                            Xóa
                        </button>
                    </div>
                </div>
            @empty
                <p>Giỏ hàng trống</p>
            @endforelse

            @if(count($cart) > 0)
                <div class="cart-total">
                    <h3>Tổng cộng: {{ number_format($totalPrice) }} VND</h3>
                </div>
            @endif
        </div>
    </div>

    <!-- Payment Column -->
    @if(count($cart) > 0)
        <div class="payment-column">
            <h2 class="payment-title">Payment Information</h2>
            <form class="payment-form">
                <div class="form-group">
                    <label class="form-label">Card Number</label>
                    <input type="text" class="form-input" placeholder="1234 5678 9012 3456">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Expiry Date</label>
                        <input type="text" class="form-input" placeholder="MM/YY">
                    </div>
                    <div class="form-group">
                        <label class="form-label">CVV</label>
                        <input type="text" class="form-input" placeholder="123">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Billing Address</label>
                    <input type="text" class="form-input" placeholder="123 University St, City, Country">
                </div>

                <button type="submit" class="submit-button">Submit</button>
            </form>
        </div>
    @endif
</div>
@endsection
