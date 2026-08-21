@extends('layouts.app')

@section('title', __('landing.home'))

@section('meta_description', 'Calories by Fatima — your healthy food store in Saida, Lebanon. Shop organic products, dried & freeze-dried fruits, sugar-free and protein snacks, sweeteners, honey and supplements with delivery across Lebanon.')

@section('content')
<div class="slider">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/images/hero.png') }}" class="d-block hero-img" fetchpriority="high"
                    decoding="async" alt="Calories by Fatima — healthy food store">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/images/hero-3.png') }}" class="d-block hero-img" loading="lazy"
                    decoding="async" alt="Healthy living starts here">
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    {{-- Categories --}}
    <div class="mb-5 pb-2">
        <h2 class="section-heading">{{ __('landing.shop_by_category') }}</h2>
        <p class="section-sub">{{ __('landing.find_your_wellness') }}</p>
        <div class="owl-carousel owl-theme categories">
            @foreach ($categories as $category)
            <div class="category-item">
                <a href="{{ route('shop') }}?category={{ urlencode($category->name) }}"
                    class="text-decoration-none">
                    <div class="category-image">
                        <img src="{{ asset($category->image) }}" class="img-fluid category-img" decoding="async"
                            alt="{{ $category->name }}">
                    </div>
                    <h5 class="category-title">{{ gtrans($category->name) }}</h5>
                    <span class="category-count">{{ $category->products_count }} {{ __('landing.products') }}</span>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Featured category banners --}}
    <div class="row g-4 mb-5 pb-2">
        <div class="col-12 col-md-4">
            <a href="{{ route('shop') }}?category={{ urlencode('Organic') }}" class="promo-banner"
                style="background-image: url('{{ asset('assets/images/Organic.png') }}')">
                <div class="promo-content">
                    <h3 class="promo-title">{{ __('landing.organic_products') }}</h3>
                    <p class="promo-text">{{ __('landing.msg1') }}</p>
                    <span class="btn-shop">{{ __('landing.shopnow') }} <i class="fa-solid fa-arrow-right"></i></span>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-4">
            <a href="{{ route('shop') }}?category={{ urlencode('Sugar Free/Healthy Snacks') }}" class="promo-banner"
                style="background-image: url('{{ asset('assets/images/Sugar Free Healthy Snacks.png') }}')">
                <div class="promo-content">
                    <h3 class="promo-title">{{ __('landing.sugar-free') }} {{ __('landing.healthy_snacks') }}</h3>
                    <p class="promo-text">{{ __('landing.msg2') }}</p>
                    <span class="btn-shop">{{ __('landing.shopnow') }} <i class="fa-solid fa-arrow-right"></i></span>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-4">
            <a href="{{ route('shop') }}?category={{ urlencode('Dried Fruits') }}" class="promo-banner"
                style="background-image: url('{{ asset('assets/images/Dried Fruits.png') }}')">
                <div class="promo-content">
                    <h3 class="promo-title">{{ __('landing.dried_fruits') }}</h3>
                    <p class="promo-text">{{ __('landing.tasty_and_healthy') }}</p>
                    <span class="btn-shop">{{ __('landing.shopnow') }} <i class="fa-solid fa-arrow-right"></i></span>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-6">
            <a href="{{ route('shop') }}?category={{ urlencode('Weight Loss Supplements') }}" class="promo-banner"
                style="background-image: url('{{ asset('assets/images/Weight Loss Supplements.png') }}')">
                <div class="promo-content">
                    <h3 class="promo-title">{{ __('landing.weight_loss_supplements') }}</h3>
                    <p class="promo-text">{{ __('landing.msg3') }}</p>
                    <span class="btn-shop">{{ __('landing.shopnow') }} <i class="fa-solid fa-arrow-right"></i></span>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-6">
            <a href="{{ route('shop') }}?category={{ urlencode('Protein Snacks') }}" class="promo-banner"
                style="background-image: url('{{ asset('assets/images/Protein Snacks.png') }}')">
                <div class="promo-content">
                    <h3 class="promo-title">{{ __('landing.protein_snacks') }}</h3>
                    <p class="promo-text">{{ __('landing.msg4') }}</p>
                    <span class="btn-shop">{{ __('landing.shopnow') }} <i class="fa-solid fa-arrow-right"></i></span>
                </div>
            </a>
        </div>
    </div>

    {{-- Best sellers --}}
    <div class="mb-5 pb-2">
        <h2 class="section-heading">{{ __('landing.best_sellers') }}</h2>
        <p class="section-sub">{{ __('landing.tasty_and_healthy') }}</p>
        <div class="owl-carousel owl-theme products">
            @foreach ($products as $product)
            <div class="category-item">
                <a href="{{ route('product', $product->name) }}" class="text-decoration-none">
                    <div class="category-image">
                        <img src="{{ asset($product->image) }}" class="img-fluid category-img" decoding="async"
                            alt="{{ $product->name }}">
                    </div>
                    <h5 class="category-title">{{ gtrans($product->name) }}</h5>
                    <span class="category-count">{{ __('landing.view_product') }}</span>
                </a>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection