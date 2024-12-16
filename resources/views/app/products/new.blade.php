@extends('app.layouts.app')

@section('title', 'products')

@section('sub-title', 'new')

@section('actions')
<a href="{{ url()->previous() }}" class="btn btn-sm fw-bold btn-secondary">
    Back
</a>
@endsection

@section('content')
<div class="container mt-5">
    <div class="card">
        <form action="{{ route('products.create') }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            <div class="card-head">
                <h1 class="text-center text-primary">New Product</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name..."
                                value="{{ old('name') }}" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label required">Category</label>
                            <select name="category_id" class="form-select" data-control="select2" required
                                data-placeholder="Select an option">
                                <option value=""></option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' :
                                    '' }}>{{ ucwords($category->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required form-label">Stock</label>
                            <input type="number" class="form-control" name="stock" step="any" min="0"
                                placeholder="Enter Stock..." value="{{ old('stock') }}" required />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required form-label">Cost</label>
                            <input type="number" class="form-control" name="cost" step="any" min="0"
                                placeholder="Enter Cost..." value="{{ old('cost') }}" required />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required form-label">Price</label>
                            <input type="number" class="form-control" name="price" step="any" min="0"
                                placeholder="Enter Price..." value="{{ old('price') }}" required />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Compare Price</label>
                            <input type="number" class="form-control" name="compare_price" step="any" min="0"
                                placeholder="Enter Compare Price..." value="{{ old('compare_price') }}" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"
                                placeholder="Enter Description...">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-4 form-label">Image</label>
                            <div class="col-8">
                                <!--begin::Image input-->
                                <div class="image-input image-input-empty" data-kt-image-input="true">
                                    <!--begin::Image preview wrapper-->
                                    <div class="image-input-wrapper w-100px h-100px"
                                        style="background-image: url({{ asset('assets/images/no_img.png') }})"></div>
                                    <!--end::Image preview wrapper-->

                                    <!--begin::Edit button-->
                                    <label
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        data-bs-dismiss="click" title="Change image">
                                        <i class="fa fa-pen"></i>

                                        <!--begin::Inputs-->
                                        <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Edit button-->

                                    <!--begin::Cancel button-->
                                    <span
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                        data-bs-dismiss="click" title="Remove image">
                                        <i class="fa fa-close"></i>
                                    </span>
                                    <!--end::Cancel button-->

                                    <!--begin::Remove button-->
                                    <span
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                        data-bs-dismiss="click" title="Remove image">
                                        <i class="fa fa-close"></i>
                                    </span>
                                    <!--end::Remove button-->
                                </div>
                                <!--end::Image input-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer pt-0">
                <div class="d-flex align-items-center justify-content-around">
                    <button type="reset" class="btn btn-danger clear-btn">Clear</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection