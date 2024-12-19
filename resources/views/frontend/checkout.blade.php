@extends('layouts.app')

@section('title', __('landing.checkout'))

@section('content')
<section class="pb-5">
    <div class="container">
        <div class="checkout-container">
            <form class="form" action="{{ route('order') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-7">
                        <div class="card p-4">
                            <h3 class="text-secondary text-center mb-4">{{ __('landing.checkout') }}</h3>

                            <!-- Contact Information -->
                            <div class="mb-4">
                                <label for="email" class="form-label">{{ __('landing.email') }}</label>
                                <input type="email" name="email" class="form-control" placeholder="you@example.com"
                                    required>
                            </div>

                            <!-- Shipping Information -->
                            <div class="mb-4">
                                <h4 class="text-secondary mb-3">{{ __('landing.shipping_address') }}</h4>
                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('landing.name') }}</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="John Doe"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">{{ __('landing.phone') }}</label>
                                    <input type="tel" id="phone" name="phone" class="form-control"
                                        placeholder="+961 70 285 659" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">{{ __('landing.address') }}</label>
                                    <input type="text" id="address" name="address" class="form-control"
                                        placeholder="123 Main St" required>
                                </div>
                                <div class="mb-3">
                                    <label for="city" class="form-label">{{ __('landing.city') }}</label>
                                    <input type="text" id="city" name="city" class="form-control" placeholder="Beirut"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="country" class="form-label">{{ __('landing.country') }}</label>
                                    <input type="text" id="country" name="country" value="Lebanon" class="form-control"
                                        placeholder="Lebanon" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h4 class="text-primary mb-3">{{ __('landing.payment_info') }}</h4>

                                <div class="mb-3">
                                    <label for="method" class="form-label">{{ __('landing.payment_method') }}</label>
                                    <select id="method" name="payment_method" class="form-select" required>
                                        <option value="cash on delivery" selected>{{ __('landing.cash_on_delivery') }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h4 class="text-primary mb-3">{{ __('landing.additional_info') }}</h4>

                                <div class="mb-3">
                                    <label for="notes" class="form-label">{{ __('landing.notes') }} ({{
                                        __('landing.optional') }})</label>
                                    <textarea type="text" id="notes" name="notes" class="form-control" rows="3"
                                        placeholder="Notes about your order..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-5">
                        <div class="card p-4 border-primary">
                            <h4 class="text-secondary text-center mb-4">{{ __('landing.order_summary') }}</h4>
                            <div class="summary-card" id="cart-items-container">
                                <!-- Cart Items will be populated here dynamically -->
                            </div>

                            <!-- Price Breakdown -->
                            <div class="summary-item">
                                <span>{{ __('landing.subtotal') }}</span>
                                <span id="subtotal-price">$0.00</span>
                            </div>
                            <div class="summary-item">
                                <span>{{ __('landing.shipping') }}</span>
                                <span id="shipping-price">$10.00</span>
                            </div>
                            <div class="summary-item total-price">
                                <span>{{ __('landing.total') }}</span>
                                <span id="total-price">$0.00</span>
                            </div>

                            <button type="submit" class="btn btn-cta">{{ __('landing.complete_order')
                                }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get cart from cookies
        const cart = document.cookie
            .split('; ')
            .find(row => row.startsWith('cart='))
            ?.split('=')[1];
        const cartData = cart ? JSON.parse(decodeURIComponent(cart)) : [];

        const cartItemsContainer = document.getElementById('cart-items-container');
        const subtotalElement = document.getElementById('subtotal-price');
        const totalElement = document.getElementById('total-price');
        const shippingCost = 10; // Flat shipping cost

        let subtotal = 0;

        // Populate cart items
        cartData.forEach(item => {
            subtotal += item.price * item.quantity;

            const cartItem = document.createElement('div');
            cartItem.classList.add('cart-item', 'd-flex', 'align-items-center', 'mb-3');

            cartItem.innerHTML = `
                <img src="${item.image}" alt="${item.name}" class="me-3" style="width: 60px; height: 60px; object-fit: cover;">
                <div>
                    <p class="mb-0">${item.name}</p>
                    <small>{{ __('landing.quantity') }}: ${item.quantity}</small>
                </div>
                <p class="ms-auto">$${(item.price * item.quantity).toFixed(2)}</p>
            `;

            cartItemsContainer.appendChild(cartItem);
        });

        // Update price breakdown
        subtotalElement.textContent = `$${subtotal.toFixed(2)}`;
        totalElement.textContent = `$${(subtotal + shippingCost).toFixed(2)}`;
    });
</script>
@endsection
