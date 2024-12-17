@extends('layouts.app')

@section('title')
Home
@endsection

@section('content')
<section>
    <div class="container">
        <div class="row mb-5">
            <div class="col-4">
                <div class="card card-1">
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
            <div class="col-4">
                <div class="card card-2">
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
            <div class="col-4">
                <div class="card card-3">
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
            <div class="col-6">
                <div class="card card-4">
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
            <div class="col-6">
                <div class="card card-5">
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
    </div>
</section>
@endsection