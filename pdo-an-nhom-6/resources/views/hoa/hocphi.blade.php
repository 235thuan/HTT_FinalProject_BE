@extends('thuan.layouts.app')


@section('content')

    <style>
        .cart-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid #eee;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .cart-item:hover {
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .item-image {
            width: 100px;
            height: 100px;
            margin-right: 1.5rem;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 6px;
        }

        .item-details {
            flex: 1;
        }

        .item-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .item-subtitle {
            color: #666;
            margin-bottom: 0;
        }

        .item-price-column {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 0.5rem;
        }

        .item-price {
            font-size: 1.1rem;
            font-weight: bold;
            color: #2c3e50;
        }

        .remove-button {
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .remove-button:hover {
            background-color: #dc3545;
            color: white;
        }

        .empty-cart {
            text-align: center;
            padding: 2rem;
            color: #666;
        }

        .empty-cart i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .cart-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            margin-top: 1rem;
            border-top: 2px solid #eee;
        }

        .total-label {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
        }

        .total-price {
            font-size: 1.3rem;
            font-weight: bold;
            color: #2c3e50;
        }

        .delete-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            background-color: #fff;
            color: #dc3545;
            border: 2px solid #dc3545;
        }

        .delete-btn:hover {
            background-color: #dc3545;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
        }

        .delete-btn i {
            font-size: 18px;
        }

        .delete-btn span {
            font-weight: 500;
        }

        .form-input:invalid {
            border-color: #dc3545;
        }

        .form-input:valid {
            border-color: #28a745;
        }

        .toast-container {
            position: fixed;
            top: 30px;
            right: 20px;
            z-index: 9999;
        }

        .toast {
            position: relative;
            width: 400px;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 10px;
            background: #fff;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            transform: translateX(100%);
            animation: slideIn 0.3s ease forwards;
        }

        .toast-success {
            border-left: 6px solid #4CAF50;
        }

        .toast-error {
            border-left: 6px solid #ff5252;
        }

        .toast-content {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .toast i {
            font-size: 25px;
            margin-right: 15px;
        }

        .toast-success i {
            color: #4CAF50;
        }

        .toast-error i {
            color: #ff5252;
        }

        .message {
            display: flex;
            flex-direction: column;
        }

        .text {
            font-size: 16px;
            font-weight: 400;
            color: #666;
        }

        .text-1 {
            font-weight: 600;
            color: #333;
            margin-bottom: 3px;
        }

        .close {
            padding: 5px;
            cursor: pointer;
            opacity: 0.5;
            transition: opacity 0.3s ease;
        }

        .close:hover {
            opacity: 1;
        }

        .progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 100%;
            background: #ddd;
        }

        .progress:before {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            height: 100%;
            width: 100%;
            background-color: #4CAF50;
            animation: progress 3s linear forwards;
        }

        .toast-error .progress:before {
            background-color: #ff5252;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(0);
            }
        }

        @keyframes progress {
            100% {
                right: 100%;
            }
        }

        .semester-select {
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .semester-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #333;
        }

        .semester-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            background-color: white;
            transition: all 0.3s ease;
        }

        .semester-input:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }

        .semester-input optgroup {
            font-weight: 600;
            color: #333;
        }

        .semester-input option {
            padding: 8px;
            font-weight: normal;
        }
    </style>
    <style>
        .toast .confirm-buttons {
            display: flex;
            gap: 8px;
            margin-top: 8px;
            justify-content: flex-end;
            padding-right: 15px;
        }

        .toast .confirm-button {
            border: none;
            padding: 5px 15px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .toast .confirm-yes {
            background: #ff3333;
            color: white;
        }

        .toast .confirm-no {
            background: #f2f2f2;
            color: #333;
        }

        .toast .confirm-yes:hover {
            background: #ff0000;
        }

        .toast .confirm-no:hover {
            background: #e6e6e6;
        }
    </style>

    <div class="container d-flex justify-items-center align-middle" style="margin:auto">
        <div class="row" style="margin:auto">
            <!-- Left Column - Cart Items -->
            <div class="col-left">
                <h2 class="cart-title">Your Cart</h2>
                <div class="cart-items">
                    @forelse($cart as $id => $item)
                        <div class="cart-item">
                            <div class="item-image">
                                <img src="{{ asset($item['image_url']) }}"
                                     alt="{{ $item['ten_chuyennganh'] }}"
                                     onerror="this.src='{{ asset('storage/thuan/default.png') }}'">
                            </div>
                            <div class="item-details">
                                <h3 class="item-title">{{ $item['ten_chuyennganh'] }}</h3>
                                <p class="item-subtitle">Khoa: {{ $item['ten_khoa'] }}</p>
                            </div>
                            <div class="item-price-column">
                                <span class="item-price">{{ number_format($item['price']) }} VND</span>
                                <button type="button"
                                        class="btn btn-danger delete-btn"
                                        data-id="{{ $id }}"
                                        onclick="removeCartItem('{{ $id }}')">
                                    <i class="fas fa-trash-alt"></i>
                                    <span>Xóa</span>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="empty-cart">
                            <i class="fas fa-shopping-cart"></i>
                            <p>Giỏ hàng trống</p>
                        </div>
                    @endforelse

                    @auth
                        @if(count($cart) > 0)
                            <div class="cart-total">
                                <span class="total-label">Tổng cộng:</span>
                                <span class="total-price" id="displayTotal" data-default-price="{{ $totalPrice }}">
                                    {{ number_format($totalPrice) }} VND
                                </span>
                            </div>

                            <div class="semester-select">
                                <label class="semester-label">Chọn kỳ học thanh toán:</label>
                                <select name="ky_hoc" class="semester-input" id="semesterSelect" onchange="updateSemesterPrice(this)">
                                    <option value="">-- Chọn kỳ học --</option>
                                    @foreach($kyHocData as $chuyenNganhId => $data)
                                        <optgroup label="{{ $data['ten_chuyennganh'] }}">
                                            @foreach($data['ky_hoc'] as $kyHoc)
                                                <option 
                                                    value="{{ $kyHoc->ky_hoc }}" 
                                                    data-price="{{ $kyHoc->total_price }}"
                                                    data-chuyennganh="{{ $chuyenNganhId }}"
                                                    {{ isset($selectedSemester) && $selectedSemester['ky_hoc'] == $kyHoc->ky_hoc ? 'selected' : '' }}>
                                                    Kỳ {{ $kyHoc->ky_hoc }} - {{ number_format($kyHoc->total_price) }} VND
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>



                        @endif
                    @else
                        <div class="alert alert-warning">
                            Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để xem giỏ hàng của bạn.
                        </div>
                    @endauth

                </div>
            </div>

            <!-- Right Column - Billing Form -->
            @if(count($cart) > 0)
                <div class="col-right">
                    <h2 class="payment-title">Billing Information</h2>
                    <form action="{{ route('hoa.hocphi.payment') }}" method="POST" class="payment-form">
                        @csrf

                        <div class="form-group">
                            <label class="form-label">Card Number</label>
                            <input type="text"
                                   name="card_number"
                                   class="form-input"
                                   placeholder="1234567812345678"
                                   value="{{ old('card_number') }}"
                                   pattern="\d{16}"
                                   maxlength="16"
                                   required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Expiry Date</label>
                                <input type="text"
                                       name="expiry_date"
                                       class="form-input"
                                       placeholder="MM/YY"
                                       value="{{ old('expiry_date') }}"
                                       pattern="\d{2}/\d{2}"
                                       maxlength="5"
                                       required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">CVV</label>
                                <input type="text"
                                       name="cvv"
                                       class="form-input"
                                       placeholder="123"
                                       value="{{ old('cvv') }}"
                                       pattern="\d{3}"
                                       maxlength="3"
                                       required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Billing Address</label>
                            <input type="text"
                                   name="billing_address"
                                   class="form-input"
                                   placeholder="123 Main Street, City A"
                                   value="{{ old('billing_address') }}"
                                   required>
                        </div>

                        <button type="submit" class="submit-button">Submit Payment</button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container">
        @if(session('success'))
            <div class="toast toast-success">
                <div class="toast-content">
                    <i class="fas fa-check-circle"></i>
                    <div class="message">
                        <span class="text text-1">Thành công</span>
                        <span class="text text-2">{{ session('success') }}</span>
                    </div>
                </div>
                <i class="fa-solid fa-xmark close"></i>
                <div class="progress"></div>
            </div>
        @endif

        @if(session('error'))
            <div class="toast toast-error">
                <div class="toast-content">
                    <i class="fas fa-exclamation-circle"></i>
                    <div class="message">
                        <span class="text text-1">Lỗi</span>
                        <span class="text text-2">{{ session('error') }}</span>
                    </div>
                </div>
                <i class="fa-solid fa-xmark close"></i>
                <div class="progress"></div>
            </div>
        @endif
    </div>


    @section('scripts')
        <script>
            function removeCartItem(id) {
                // Create temporary toast for confirmation
                const toastContainer = document.querySelector('.toast-container');
                const confirmToast = document.createElement('div');
                confirmToast.className = 'toast toast-warning';
                confirmToast.innerHTML = `
        <div class="toast-content">
            <i class="fas fa-question-circle"></i>
            <div class="message">
                <span class="text text-1 ">Xác nhận</span>
                <span class="text text-2 ">Bạn có chắc muốn xóa khỏi giỏ hàng?</span>
            </div>
        </div>
        <button class="btn btn-sm btn-danger confirm-yes p-5 m-5">Có</button>

        <button class="btn btn-sm btn-check confirm-no p-5 m-5">Không</button>
        <div class="progress"></div>
    `;

                toastContainer.appendChild(confirmToast);

                // Handle confirmation
                confirmToast.querySelector('.confirm-yes').addEventListener('click', function () {
                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');

                    fetch(`/hoa/hocphi/remove/${id}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                        .then(() => {
                            window.location.reload();
                        })
                        .catch(() => {
                            window.location.reload();
                        });
                });

                // Handle cancel
                confirmToast.querySelector('.confirm-no').addEventListener('click', function () {
                    toastContainer.removeChild(confirmToast);
                });
            }


            function updateSemesterPrice(select) {
                const displayTotal = document.getElementById('displayTotal');
                const defaultPrice = displayTotal.getAttribute('data-default-price');
                const selectedOption = select.options[select.selectedIndex];
                
                if (selectedOption.value) {
                    const semesterPrice = selectedOption.getAttribute('data-price');
                    displayTotal.textContent = new Intl.NumberFormat('vi-VN').format(semesterPrice) + ' VND';
                    
                    // Save selection to session
                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('ky_hoc', selectedOption.value);
                    formData.append('price', semesterPrice);
                    formData.append('chuyennganh_id', selectedOption.getAttribute('data-chuyennganh'));

                    fetch('{{ route("hoa.hocphi.updateSession") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    });
                } else {
                    // Reset to default price if no semester selected
                    displayTotal.textContent = new Intl.NumberFormat('vi-VN').format(defaultPrice) + ' VND';
                    
                    // Clear session selection
                    fetch('{{ route("hoa.hocphi.updateSession") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: new FormData()
                    });
                }
            }

            // Initialize price on page load
            document.addEventListener('DOMContentLoaded', function() {
                const semesterSelect = document.getElementById('semesterSelect');
                if (semesterSelect.value) {
                    updateSemesterPrice(semesterSelect);
                }
            });

            document.querySelector('input[name="expiry_date"]').addEventListener('input', function (e) {
                let value = e.target.value;
                value = value.replace(/\D/g, '');
                if (value.length >= 2) {
                    value = value.slice(0, 2) + '/' + value.slice(2);
                }
                e.target.value = value.slice(0, 5);
            });

            document.addEventListener('DOMContentLoaded', function () {
                const toasts = document.querySelectorAll('.toast');

                toasts.forEach(toast => {
                    // Tự động đóng sau 3 giây
                    setTimeout(() => {
                        toast.style.animation = 'slideOut 0.3s ease forwards';
                        setTimeout(() => {
                            toast.remove();
                            // Nếu là toast thành công và có chứa text "Thanh toán thành công", quay về trang trước
                            if (toast.classList.contains('toast-success') &&
                                toast.querySelector('.text-2').textContent.includes('Thanh toán thành công')) {
                                window.history.back();
                            }
                        }, 300);
                    }, 3000);

                    // Đóng khi click nút close
                    const closeBtn = toast.querySelector('.close');
                    if (closeBtn) {
                        closeBtn.addEventListener('click', () => {
                            toast.style.animation = 'slideOut 0.3s ease forwards';
                            setTimeout(() => {
                                toast.remove();
                                // Nếu là toast thành công và có chứa text "Thanh toán thành công", quay về trang trước
                                if (toast.classList.contains('toast-success') &&
                                    toast.querySelector('.text-2').textContent.includes('Thanh toán thành công')) {
                                    window.history.back();
                                }
                            }, 300);
                        });
                    }
                });
            });

            // Thêm animation cho slideOut
            const style = document.createElement('style');
            style.textContent = `
                @keyframes slideOut {
                from {
                transform: translateX(0);
            }
                to {
                transform: translateX(100%);
            }
            }
                `;
            document.head.appendChild(style);

            // Thêm script để cập nhật form thanh toán
            document.querySelector('.semester-input').addEventListener('change', function () {
                // Cập nhật hidden input trong form thanh toán
                const paymentForm = document.querySelector('.payment-form');
                let hiddenInput = paymentForm.querySelector('input[name="ky_hoc"]');
                if (!hiddenInput) {
                    hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'ky_hoc';
                    paymentForm.appendChild(hiddenInput);
                }
                hiddenInput.value = this.value;
            });
        </script>


        <script>


            document.querySelector('input[name="expiry_date"]').addEventListener('input', function (e) {
                let value = e.target.value;
                value = value.replace(/\D/g, '');
                if (value.length >= 2) {
                    value = value.slice(0, 2) + '/' + value.slice(2);
                }
                e.target.value = value.slice(0, 5);
            });

            document.addEventListener('DOMContentLoaded', function () {
                const toasts = document.querySelectorAll('.toast');

                toasts.forEach(toast => {
                    // Tự động đóng sau 3 giây
                    setTimeout(() => {
                        toast.style.animation = 'slideOut 0.3s ease forwards';
                        setTimeout(() => {
                            toast.remove();
                            // Nếu là toast thành công và có chứa text "Thanh toán thành công", quay về trang trước
                            if (toast.classList.contains('toast-success') &&
                                toast.querySelector('.text-2').textContent.includes('Thanh toán thành công')) {
                                window.history.back();
                            }
                        }, 300);
                    }, 3000);

                    // Đóng khi click nút close
                    const closeBtn = toast.querySelector('.close');
                    if (closeBtn) {
                        closeBtn.addEventListener('click', () => {
                            toast.style.animation = 'slideOut 0.3s ease forwards';
                            setTimeout(() => {
                                toast.remove();
                                // Nếu là toast thành công và có chứa text "Thanh toán thành công", quay về trang trước
                                if (toast.classList.contains('toast-success') &&
                                    toast.querySelector('.text-2').textContent.includes('Thanh toán thành công')) {
                                    window.history.back();
                                }
                            }, 300);
                        });
                    }
                });
            });

            // Thêm animation cho slideOut
            const style = document.createElement('style');
            style.textContent = `
                @keyframes slideOut {
                from {
                transform: translateX(0);
            }
                to {
                transform: translateX(100%);
            }
            }
                `;
            document.head.appendChild(style);

            // Thêm script để cập nhật form thanh toán
            document.querySelector('.semester-input').addEventListener('change', function () {
                // Cập nhật hidden input trong form thanh toán
                const paymentForm = document.querySelector('.payment-form');
                let hiddenInput = paymentForm.querySelector('input[name="ky_hoc"]');
                if (!hiddenInput) {
                    hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'ky_hoc';
                    paymentForm.appendChild(hiddenInput);
                }
                hiddenInput.value = this.value;
            });
        </script>
    @endsection

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('showAlert'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                @if(session('success'))
                console.log('{{ session('success') }}');
                window.history.back();
                @endif
                @if(session('error'))
                console.log('{{ session('error') }}');
                @endif
            });
        </script>
    @endif
@endsection
