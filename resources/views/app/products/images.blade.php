@extends('app.layouts.app')

@section('title', 'products')

@section('sub-title', 'images')

@section('actions')
<a href="{{ url()->previous() }}" class="btn btn-sm fw-bold btn-secondary">
    Back
</a>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">
            <div class="card">
                <div class="card-body">
                    <h3 class="font-weight-bolder text-center mb-5">New Image(s)</h3>

                    <form method="POST" action="{{ route('products.upload', $product->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="input-group input-group-outline row  my-1">
                            <label for="pictures" class="col-md-5 col-form-label text-md-end">{{ __('Pictures')
                                }}</label>

                            <div class="col-md-6">
                                <input id="pictures" class="form-control" name="images[]" type="file" multiple required>

                                @error('pictures')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-4">
                            <button type="submit" class="btn btn-primary btn-block text-white">
                                {{ __('Upload') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-body">
                    <h3 class="font-weight-bolder my-2 text-center">Secondary Images<small class="mx-3 text-danger">
                            (click to remove)</small></h3>
                    <div class="d-flex flex-wrap justify-content-center ">
                        @forelse ($product->secondary_images as $image)
                        <a class="image-wrapper" href="{{ route('secondary_images.destroy', $image->id) }}">
                            <img src="{{asset($image->path)}}" alt="" class="img-fluid m-1"
                                style="width:200px!important; height:200px!important;">
                            <span class="delete-overlay text-danger">Delete</span>
                        </a>
                        @empty
                        No Images yet...
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection