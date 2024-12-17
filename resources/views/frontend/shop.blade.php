@extends('layouts.app')

@section('title')
Shop
@endsection

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('shop') }}" method="GET" class="d-flex justify-content-center mb-4">
                    <input type="text" name="query" class="form-control rounded-pill" placeholder="Search products..." aria-label="Search products">
                    <button type="submit" class="btn btn-primary ms-2">Search</button>
                </form>
                <div class="row">
                    <div class="col-12">
                        <h5 class="text-primary fw-semibold mb-3">Categories</h5>
                        <div class="d-flex flex-wrap">
                            @foreach($categories as $category)
                            <a href="{{ route('shop', ['category' => $category->slug]) }}" class="text-decoration-none card category-card me-2 mb-3 p-3">
                                <img src="{{ $category->image }}" class="category-img" alt="">
                                <p class="text-center text-dark fw-bold mt-4">{{ $category->name }}</p>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach($products as $product)
                    <div class="col-3 mb-3">
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
@endsection