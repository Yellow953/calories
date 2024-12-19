@extends('layouts.app')

@section('title', __('landing.checkout'))

@section('content')
<br><br><br><br>
<div class="container py-5">
    <div class="checkout-container">
        <form class="form" action="{{ route('order') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-7">
                    <div class="card p-4">
                        <h3 class="text-secondary mb-4">{{__('landing.checkout')}}</h3>

                        <!-- Contact Information -->
                        <div class="mb-4">
                            <label for="email" class="form-label">{{__('landing.email')}}</label>
                            <input type="email" name="email" class="form-control" placeholder="you@example.com"
                                required>
                        </div>

                        <!-- Shipping Information -->
                        <div class="mb-4">
                            <h4 class="text-secondary mb-3">{{__('landing.shipping_address')}}</h4>
                            <div class="mb-3">
                                <label for="name" class="form-label">{{__('landing.name')}}</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="John Doe"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="phoen" class="form-label">{{__('landing.phone')}}</label>
                                <input type="tel" id="phoen" name="phone" class="form-control"
                                    placeholder="+961 70 285 659" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">{{__('landing.address')}}</label>
                                <input type="text" id="address" name="address" class="form-control"
                                    placeholder="123 Main St" required>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">{{__('landing.city')}}</label>
                                <input type="text" id="city" name="city" class="form-control" placeholder="Beirut"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="country" class="form-label">{{__('landing.country')}}</label>
                                <input type="text" id="country" name="country" value="Lebanon" class="form-control"
                                    placeholder="Lebanon" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h4 class="text-primary mb-3">{{__('landing.payment_info')}}</h4>

                            <div class="mb-3">
                                <label for="method" class="form-label">{{__('landing.payment_method')}}</label>
                                <select id="method" class="form-select" required>
                                    <option value="cash on delivery" selected>{{__('landing.cash_on_delivery')}}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h4 class="text-primary mb-3">{{__('landing.additional_info')}}</h4>

                            <div class="mb-3">
                                <label for="method" class="form-label">{{__('landing.notes')}}
                                    ({{__('landing.optional')}})</label>
                                <textarea type="text" id="notes" name="notes" class="form-control" rows="3"
                                    placeholder="Notes about your order..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-5">
                    <div class="card p-4 border-primary">
                        <h4 class="text-secondary mb-4">{{__('landing.order_summary')}}</h4>
                        <div class="summary-card">
                            <!-- Example Cart Items -->
                            <div class="cart-item">
                                <img src="https://via.placeholder.com/60" alt="Product Image">
                                <div>
                                    <p class="mb-0">Product Name</p>
                                    <small>Quantity: 1</small>
                                </div>
                                <p class="ms-auto">$25.00</p>
                            </div>
                            <div class="cart-item">
                                <img src="https://via.placeholder.com/60" alt="Product Image">
                                <div>
                                    <p class="mb-0">Another Product</p>
                                    <small>Quantity: 2</small>
                                </div>
                                <p class="ms-auto">$50.00</p>
                            </div>

                            <!-- Price Breakdown -->
                            <div class="summary-item">
                                <span>{{__('landing.subtotal')}}</span>
                                <span>$75.00</span>
                            </div>
                            <div class="summary-item">
                                <span>{{__('landing.shipping')}}</span>
                                <span>$5.00</span>
                            </div>
                            <div class="summary-item total-price">
                                <span>{{__('landing.total')}}</span>
                                <span>$80.00</span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-cta">{{__('landing.complete_order')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
