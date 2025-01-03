@extends('layouts.app')

@section('title', __('landing.checkout'))

@section('content')
<section class="pb-5">
    <div class="container">
        <div class="checkout-container">
            @include('app.layouts._flash')

            <form class="form" action="{{ route('order') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-secondary text-center mb-4">{{ __('landing.checkout') }}</h2>
                    </div>
                    <!-- Left Column -->
                    <div class="col-md-7">
                        <div class="card p-4">
                            <!-- Shipping Information -->
                            <div class="mb-4">
                                <h4 class="text-primary text-center mb-3">{{ __('landing.shipping_address') }}</h4>
                                <div class="mb-3">
                                    <label for="name" class="form-label text-secondary">{{ __('landing.name') }} *
                                    </label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="John Doe"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label text-secondary">{{ __('landing.phone') }} *
                                    </label>
                                    <input type="tel" id="phone" name="phone" class="form-control"
                                        placeholder="+961 81 893 865" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label text-secondary">{{ __('landing.email')
                                        }}</label>
                                    <input type="email" name="email" class="form-control" placeholder="you@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="country" class="form-label text-secondary">{{ __('landing.country') }} *
                                    </label>
                                    <select name="country" id="country" class="form-select" required>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country }}" {{ $country=="Lebanon" ? 'selected' : '' }}>{{
                                            $country }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label text-secondary">{{ __('landing.address') }} *
                                    </label>
                                    <input type="text" id="address" name="address" class="form-control"
                                        placeholder="123 Main St" required>
                                </div>
                                <div class="mb-3">
                                    <label for="city" class="form-label text-secondary">{{ __('landing.city') }} *
                                    </label>
                                    <input type="text" id="city" name="city" class="form-control" placeholder="Beirut"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="zip" class="form-label text-secondary">{{ __('landing.zip') }}</label>
                                    <input type="number" min="0" step="1" id="zip" name="zip" class="form-control"
                                        placeholder="1234">
                                </div>
                            </div>

                            <div class="mb-4">
                                <h4 class="text-primary text-center mb-3">{{ __('landing.payment_info') }}</h4>

                                <div class="mb-3">
                                    <label for="method" class="form-label text-secondary">{{
                                        __('landing.payment_method') }}</label>
                                    <select id="method" name="payment_method" class="form-select" required>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h4 class="text-primary text-center mb-3">{{ __('landing.additional_info') }}</h4>

                                <div class="mb-3">
                                    <label for="notes" class="form-label text-secondary">{{ __('landing.notes') }} ({{
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
                            <h4 class="text-primary text-center mb-4">{{ __('landing.order_summary') }}</h4>
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
        const shippingCost = 10;

        let subtotal = 0;
        let count = 0;

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
                <input type="hidden" name="cart[${count}][id]" value="${item.id}">
                <input type="hidden" name="cart[${count}][name]" value="${item.name}">
                <input type="hidden" name="cart[${count}][image]" value="${item.image}">
                <input type="hidden" name="cart[${count}][quantity]" value="${item.quantity}">
                <input type="hidden" name="cart[${count}][price]" value="${item.price}">
            `;
            count++;

            cartItemsContainer.appendChild(cartItem);
        });

        subtotalElement.textContent = `$${subtotal.toFixed(2)}`;
        totalElement.textContent = `$${(subtotal + shippingCost).toFixed(2)}`;
    });

    document.addEventListener('DOMContentLoaded', function () {
        const countrySelect = document.getElementById('country');
        const paymentMethodSelect = document.getElementById('method');

        const updatePaymentMethods = (country) => {
            paymentMethodSelect.innerHTML = '';

            if (country === 'Lebanon') {
                const codOption = document.createElement('option');
                codOption.value = 'cash on delivery';
                codOption.textContent = '{{ __('landing.cash_on_delivery') }}';
                paymentMethodSelect.appendChild(codOption);

                const cardOption = document.createElement('option');
                cardOption.value = 'card';
                cardOption.textContent = '{{ __('landing.card') }}';
                paymentMethodSelect.appendChild(cardOption);

                const whishOption = document.createElement('option');
                whishOption.value = 'whish';
                whishOption.textContent = '{{ __('landing.whish') }}';
                paymentMethodSelect.appendChild(whishOption);
            } else {
                const cardOption = document.createElement('option');
                cardOption.value = 'card';
                cardOption.textContent = '{{ __('landing.card') }}';
                paymentMethodSelect.appendChild(cardOption);

                const whishOption = document.createElement('option');
                whishOption.value = 'whish';
                whishOption.textContent = '{{ __('landing.whish') }}';
                paymentMethodSelect.appendChild(whishOption);
            }
        };

        countrySelect.addEventListener('change', function () {
            const selectedCountry = countrySelect.value;
            updatePaymentMethods(selectedCountry);
        });

        updatePaymentMethods(countrySelect.value);
    });

</script>
@endsection
