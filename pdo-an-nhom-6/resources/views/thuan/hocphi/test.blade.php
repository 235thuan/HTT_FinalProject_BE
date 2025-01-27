@extends('thuan.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Left Column - Cart Items -->
        <div class="col-left">
            <h2 class="cart-title">Your Cart</h2>
            <div class="cart-items">
                @foreach($chuyenNganhs as $cn)
                    <div class="cart-item">
                        <div class="item-image">
                            <img src="{{ asset('storage/thuan/default.png') }}" alt="Course">
                        </div>
                        <div class="item-details">
                            <h3 class="item-title">{{ $cn->ten_chuyennganh }}</h3>
                            <p class="item-subtitle">Khoa: {{ $cn->ten_khoa }}</p>
                        </div>
                        <div class="item-price-column">
                            <span class="item-price">
                                {{ isset($cn->total_price) ? number_format($cn->total_price) . ' VND' : '0 VND' }}
                            </span>
                        </div>
                    </div>
                @endforeach

                <!-- Total Price -->
                <div class="cart-total">
                    <span class="total-label">Tổng cộng:</span>
                    <span class="total-price">
                        {{ isset($totalPrice) ? number_format($totalPrice) . ' VND' : '0 VND' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Right Column - Billing Form -->
        <div class="col-right">
            <h2 class="payment-title">Billing Information</h2>
            <div class="payment-form">
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

                <button type="submit" class="submit-button">Submit Payment</button>
            </div>
        </div>
    </div>
</div>
@endsection 