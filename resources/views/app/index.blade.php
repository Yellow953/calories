@extends('app.layouts.app')

@section('title', 'app')

@section('content')
<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mt-1 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-md-4 my-auto">
                    <div class="card card-flush h-lg-100 animate-on-scroll slide-left">
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end pt-6">
                            <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid">
                        </div>
                        <!--end::Card body-->
                    </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-8 card h-lg-100 bg-broccoli my-auto">
                    <!--begin::Body-->
                    <div class="card-body animate-on-scroll slide-right">
                        <h1 class="text-center mt-1 mb-10 heading text-shadow-dark">Calories</h1>
                        <p class="text-center paragraph text-shadow-dark">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur laboriosam corrupti
                            sapiente itaque ea quos, sed recusandae quod nemo eveniet consequuntur reprehenderit numquam
                            cupiditate? Amet dolorum odit ullam esse velit!
                        </p>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col -->
                <div class="col-md-3">
                    <!--begin::Card widget 3-->
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100 bg-primary">
                        <!--begin::Header-->
                        <div class="card-header pt-5 d-flex justify-content-center">
                            <!--begin::Icon-->
                            <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                style="border: 1px dashed white;">
                                <i class="bi bi-person-fill text-white fs-2qx lh-0"></i>
                            </div>
                            <!--end::Icon-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body p-0 pb-3">
                            <!--begin::Info-->
                            <div class="text-center">
                                <div class="fs-4hx text-white fw-bold" data-kt-countup="true"
                                    data-kt-countup-value="{{ $categories_count }}" data-kt-countup-prefix="">
                                    {{ $categories_count }}
                                </div>
                                <div class="fw-bold fs-6 text-white">
                                    Categories
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 3-->
                </div>
                <!--end::Col-->

                <!-- start::Col -->
                <div class="col-md-3">
                    <!--begin::Card widget 3-->
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100 bg-primary">
                        <!--begin::Header-->
                        <div class="card-header pt-5 d-flex justify-content-center">
                            <!--begin::Icon-->
                            <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                style="border: 1px dashed white;">
                                <i class="bi bi-building-fill text-white fs-2qx lh-0"></i>
                            </div>
                            <!--end::Icon-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body p-0 pb-3">
                            <!--begin::Info-->
                            <div class="text-center">
                                <div class="fs-4hx text-white fw-bold" data-kt-countup="true"
                                    data-kt-countup-value="{{ $products_count }}" data-kt-countup-prefix="">
                                    {{ $products_count }}
                                </div>
                                <div class="fw-bold fs-6 text-white">
                                    Products
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 3-->
                </div>
                <!--end::Col-->

                <!-- start::Col -->
                <div class="col-md-3">
                    <!--begin::Card widget 3-->
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100 bg-primary">
                        <!--begin::Header-->
                        <div class="card-header pt-5 d-flex justify-content-center">
                            <!--begin::Icon-->
                            <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                style="border: 1px dashed white;">
                                <i class="bi bi-file-text-fill text-white fs-2qx lh-0"></i>
                            </div>
                            <!--end::Icon-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body p-0 pb-3">
                            <!--begin::Info-->
                            <div class="text-center">
                                <div class="fs-4hx text-white fw-bold" data-kt-countup="true"
                                    data-kt-countup-value="{{ $orders_count }}" data-kt-countup-prefix="">
                                    {{ $orders_count }}
                                </div>
                                <div class="fw-bold fs-6 text-white">
                                    Orders
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 3-->
                </div>
                <!--end::Col-->

                <!-- start::Col -->
                <div class="col-md-3">
                    <!--begin::Card widget 3-->
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100 bg-primary">
                        <!--begin::Header-->
                        <div class="card-header pt-5 d-flex justify-content-center">
                            <!--begin::Icon-->
                            <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                style="border: 1px dashed white;">
                                <i class="bi bi-person-fill text-white fs-2qx lh-0"></i>
                            </div>
                            <!--end::Icon-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body p-0 pb-3">
                            <!--begin::Info-->
                            <div class="text-center">
                                <div class="fs-4hx text-white fw-bold" data-kt-countup="true"
                                    data-kt-countup-value="{{ $users_count }}" data-kt-countup-prefix="">
                                    {{ $users_count }}
                                </div>
                                <div class="fw-bold fs-6 text-white">
                                    Users
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 3-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->
@endsection