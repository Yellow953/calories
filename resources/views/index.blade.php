@extends('layouts.app')

@section('title', 'HOME')

@section('content')
<div class="container">
    <section>
        <div class="row mb-5">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card home-card card-1">
                    <img src="{{ asset('assets/images/organic.jpg') }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Organic Products</h5>
                        <p class="card-text">Organic is always the way to go</p>
                        <div>
                            <a href="#" class="btn btn-primary">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card home-card card-2">
                    <img src="{{ asset('assets/images/organic.jpg') }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Sugar-Free <br>
                            Healthy Snacks</h5>
                        <p class="card-text">Who said you need sugar?</p>
                        <div>
                            <a href="#" class="btn btn-primary">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card home-card card-3">
                    <img src="{{ asset('assets/images/organic.jpg') }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Dried Fruits</h5>
                        <p class="card-text">Tasty and healthy</p>
                        <div>
                            <a href="#" class="btn btn-primary">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="card home-card card-4">
                    <img src="{{ asset('assets/images/organic.jpg') }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Weight Loss Supplements</h5>
                        <p class="card-text">Get in shape faster than ever</p>
                        <div>
                            <a href="#" class="btn btn-primary">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="card home-card card-5">
                    <img src="{{ asset('assets/images/organic.jpg') }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Protein Snacks</h5>
                        <p class="card-text">The perfect snack to hit the gym</p>
                        <div>
                            <a href="#" class="btn btn-primary">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <h2>Categories</h2>
        <div class="owl-carousel owl-theme categories">
            @foreach ($categories as $category)
            <div class="category-item bg-white">
                <div class="category-image">
                    <a href="{{ route('shop', $category->name) }}">
                        <img src="{{ asset($category->image) }}" class="img-fluid">
                    </a>
                </div>
                <h3 class="category-title">{{ ucwords($category->name) }}</h3>
            </div>
            @endforeach
        </div>
    </section>

    <section>
        <h2>Best Sellers</h2>
        <div class="owl-carousel owl-theme products">
            @foreach ($products as $product)
            <div class="product-item bg-white">
                <div class="product-image">
                    <a href="{{ route('product', $product->name) }}">
                        <img src="{{ asset($product->image) }}" class="img-fluid">
                    </a>
                </div>
                <h3 class="product-title">{{ ucwords($product->name) }}</h3>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection