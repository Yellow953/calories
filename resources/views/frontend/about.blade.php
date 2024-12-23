@extends('layouts.app')

@section('title', __('landing.about'))

@section('content')
<div>
    <div class="overlay">
        <div class="row h-100vh w-100">
            <div class="col-md-6">
                <div class="d-flex flex-column align-items-center justify-content-center h-100">
                    <h1 class="about-title fw-bold text-center hero-title">{{ __('landing.aboutus') }}</h1>
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
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3324.732174865301!2d35.37599189778568!3d33.56033427143957!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzPCsDMzJzM3LjQiTiAzNcKwMjInNDIuNyJF!5e0!3m2!1sen!2slb!4v1734961388621!5m2!1sen!2slb"
                    height="450" style="border:0; width: 100%;" allowfullscreen="true" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection
