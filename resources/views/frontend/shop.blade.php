@extends('layouts.app')

@section('title', __('landing.shop'))

@section('meta_description', 'Browse the full range of healthy foods at Calories by Fatima — organic products, dried & freeze-dried fruits, sugar-free and protein snacks, sweeteners, honey and supplements. Delivery across Lebanon.')

@section('content')
<section class="pb-5">
    <div class="container">
        <div class="mb-5">
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

        <div class="row g-4">
            @foreach($products as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('product', $product->name) }}" class="text-decoration-none">
                    <div class="card item-card overflow-hidden h-100">
                        <img src="{{ asset($product->image) }}" class="img-fluid product-img" loading="lazy"
                            decoding="async" alt="{{ $product->name }}">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-3">{{ gtrans($product->name) }}</h5>
                            <span class="btn btn-primary mt-auto">{{ __('landing.view_product') }}</span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $products->links() }}
        </div>
    </div>
</section>
@endsection
