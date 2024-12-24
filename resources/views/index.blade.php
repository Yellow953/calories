@extends('layouts.app')

@section('title', __('landing.home'))

@php
use Stichoza\GoogleTranslate\GoogleTranslate;

$translate = app()->getLocale() != 'en';

if($translate){
$translator = new GoogleTranslate();
$translator->setTarget(app()->getLocale());
}
@endphp

@section('content')
<div class="slider">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item">
                <img src="{{ asset('assets/images/hero.png') }}" class="d-block hero-img" alt="Hero Image">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/images/hero-2.png') }}" class="d-block hero-img" alt="Hero Image 2">
            </div>
            <div class="carousel-item active">
                <img src="{{ asset('assets/images/hero-3.png') }}" class="d-block hero-img" alt="Hero Image 3">
            </div>
        </div>
    </div>
</div>
<div class="container pb-5">
    <section>
        <div>
            <h2 class="hero-title fw-bold text-center mb-4">{{__('landing.categories')}}</h2>
            <div class="owl-carousel owl-theme categories">
                @foreach ($categories as $category)
                <div class="category-item bg-white">
                    <a href="{{ route('shop') }}?category={{ urlencode($category->name) }}"
                        class="text-decoration-none text-primary">
                        <div class="category-image">
                            <img src="{{ asset($category->image) }}" class="img-fluid category-img">
                        </div>
                        <div class="d-flex flex-column category-title">
                            <h5 class="text-center mt-2">{{ $translate ? $translator->translate($category->name) :
                                $category->name }}</h5>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card home-card card-1">
                    <img src="{{ asset('assets/images/organic.jpg') }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{__('landing.organic_products')}}</h5>
                        <p class="card-text">{{__('landing.msg1')}}</p>
                        <div>
                            <a href="{{ route('shop') }}?category={{ urlencode('Organic') }}"
                                class="btn btn-primary">{{__('landing.shopnow')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card home-card card-2">
                    <img src="{{ asset('assets/images/organic.jpg') }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{__('landing.sugar-free')}} <br>
                            {{__('landing.healthy_snacks')}}
                        </h5>
                        <p class="card-text">{{__('landing.msg2')}}</p>
                        <div>
                            <a href="{{ route('shop') }}?category={{ urlencode('Sugar Free/Healthy Snacks') }}"
                                class="btn btn-primary">{{__('landing.shopnow')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card home-card card-3">
                    <img src="{{ asset('assets/images/organic.jpg') }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{__('landing.dried_fruits')}}</h5>
                        <p class="card-text">{{__('landing.tasty_and_healthy')}}</p>
                        <div>
                            <a href="{{ route('shop') }}?category={{ urlencode('Dried Fruits') }}"
                                class="btn btn-primary">{{__('landing.shopnow')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h2 class="hero-title fw-bold text-center mb-4">{{__('landing.best_sellers')}}</h2>
            <div class="owl-carousel owl-theme products">
                @foreach ($products as $product)
                <div class="category-item bg-white">
                    <div class="product-img">
                        <a href="{{ route('product', $product->name) }}">
                            <img src="{{ asset($product->image) }}" class="img-fluid category-img">
                        </a>
                    </div>
                    <h5 class="category-title text-center text-primary mt-2">{{ $translate ?
                        $translator->translate($product->name) : $product->name }}</h5>
                </div>
                @endforeach
            </div>
            </d>
        </div>

        <div class="row mt-4">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="card home-card card-4">
                    <img src="{{ asset('assets/images/organic.jpg') }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{__('landing.weight_loss_supplements')}}</h5>
                        <p class="card-text">{{__('landing.msg3')}}</p>
                        <div>
                            <a href="{{ route('shop') }}?category={{ urlencode('Weight Loss Supplements') }}"
                                class="btn btn-primary">{{__('landing.shopnow')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="card home-card card-5">
                    <img src="{{ asset('assets/images/organic.jpg') }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{__('landing.protein_snacks')}}</h5>
                        <p class="card-text">{{__('landing.msg4')}}</p>
                        <div>
                            <a href="{{ route('shop') }}?category={{ urlencode('Protein Snacks') }}"
                                class="btn btn-primary">{{__('landing.shopnow')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection