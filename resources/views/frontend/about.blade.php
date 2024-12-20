@extends('layouts.app')

@section('title', __('landing.about'))

@section('content')
<div>
    <div class="overlay">
        <div class="row h-100vh w-100">
            <div class="col-md-6">
                <div class="d-flex flex-column align-items-center justify-content-center h-100">
                    <h1 class="about-title fw-bold text-center hero-title">About Us</h1>
                    <p class="fs-4 hero-title fw-semibold text-center">A small tagline here</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-column align-items-center justify-content-center h-100 mt-4">
                    <img src="{{ asset('assets/images/about-header.png') }}" class="img-fluid about-header">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pb-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
            </div>
        </div>
    </div>
</div>
@endsection