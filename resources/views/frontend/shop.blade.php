@extends('layouts.app')

@section('title', __('landing.shop'))

@php
use Stichoza\GoogleTranslate\GoogleTranslate;

$translator = new GoogleTranslate();
$translator->setTarget(app()->getLocale());
@endphp

@section('content')
<section class="pb-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <h5 class="text-primary fw-semibold mb-3">{{__('landing.categories')}}</h5>
                        <div class="owl-carousel owl-theme categories">
                            @foreach ($categories as $category)
                            <div class="category-item bg-white">
                                <div class="category-image">
                                    <a href="{{ route('shop') }}?category={{ urlencode($category->name) }}">
                                        <img src="{{ asset($category->image) }}" class="img-fluid category-img">
                                    </a>
                                </div>
                                <h5 class="category-title text-center mt-2">{{ $translator->translate($category->name)
                                    }}</h5>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach($products as $product)
                    <div class="col-6 col-md-3 mb-3">
                        <a href="{{ route('product', $product->name) }}" class="text-decoration-none">
                            <div class="card item-card">
                                <img src="{{ $product->image }}" class="img-fluid product-img">
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{ $translator->translate($product->name) }}</h5>
                                    <a href="{{ route('product', $product->name) }}"
                                        class="btn btn-primary mt-3">{{__('landing.view_product')}}</a>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    <div class="d-flex justify-content-center mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
