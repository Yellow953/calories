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
                            <h3 class="text-secondary mb-4">{{__('landing.checkout')}}</h3>

                            <!-- Contact Information -->
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="you@example.com"
                                    required>
                            </div>

                            <!-- Shipping Information -->
                            <div class="mb-4">
                                <h4 class="text-secondary mb-3">Shipping Address</h4>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="John Doe"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="phoen" class="form-label">Phone Number</label>
                                    <input type="tel" id="phoen" name="phone" class="form-control"
                                        placeholder="+961 70 285 659" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" id="address" name="address" class="form-control"
                                        placeholder="123 Main St" required>
                                </div>
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" id="city" name="city" class="form-control" placeholder="Beirut"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" id="country" name="country" value="Lebanon" class="form-control"
                                        placeholder="Lebanon" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h4 class="text-primary mb-3">Payment Information</h4>

                                <div class="mb-3">
                                    <label for="method" class="form-label">Payment Method</label>
                                    <select id="method" class="form-select" required>
                                        <option value="cash on delivery" selected>Cash On Delivery</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h4 class="text-primary mb-3">Additional Information</h4>

                                <div class="mb-3">
                                    <label for="method" class="form-label">Notes (optional)</label>
                                    <textarea type="text" id="notes" name="notes" class="form-control" rows="3"
                                        placeholder="Notes about your order..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-5">
                        <div class="card p-4 border-primary">
                            <h4 class="text-secondary mb-4">Order Summary</h4>
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
                                    <span>Subtotal</span>
                                    <span>$75.00</span>
                                </div>
                                <div class="summary-item">
                                    <span>Shipping</span>
                                    <span>$5.00</span>
                                </div>
                                <div class="summary-item total-price">
                                    <span>Total</span>
                                    <span>$80.00</span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-cta">Complete Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection