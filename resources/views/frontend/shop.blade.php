@extends('layouts.app')

@section('title', 'Shop')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <h5 class="text-primary fw-semibold mb-3">Categories</h5>
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
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach($products as $product)
                    <div class="col-6 col-md-3 mb-3">
                        <div class="card item-card">
                            <img src="{{ $product->image }}" class="product-img" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">Price: {{ $product->price }} LBP</p>
                                <a href="" class="btn btn-primary">View Product</a>
                            </div>
                        </div>
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


<script>
    $(document).ready(function () {
        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        });
    });
</script>
@endsection