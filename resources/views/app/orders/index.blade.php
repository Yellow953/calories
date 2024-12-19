@extends('app.layouts.app')

@section('title', 'orders')

@section('actions')
@can('orders.export')
<a class="btn btn-sm fw-bold btn-primary" type="button" href="{{ route('orders.export') }}">Export Orders</a>
@endcan
@endsection

@section('filter')
<!--begin::filter-->
<div class="filter border-0 px-0 px-md-3 py-4">
    <!--begin::Form-->
    <form action="{{ route('orders') }}" method="GET" enctype="multipart/form-data" class="form">
        @csrf
        <div class="pt-0 pt-3 px-2 px-md-4">
            <!--begin::Compact form-->
            <div class="d-flex align-items-center">
                <!--begin::Input group-->
                <div class="position-relative w-md-400px me-md-2">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input type="text" class="form-control ps-10" name="order_number"
                        value="{{ request()->query('order_number') }}" placeholder="Search By Order Number..." />
                </div>
                <!--end::Input group-->
                <!--begin:Action-->
                <div class="d-flex align-items-center">
                    <button type="submit" class="btn btn-primary me-5 px-3 py-2 d-flex align-items-center">
                        Search <span class="ml-2"><i class="fas fa-search"></i></span>
                    </button>
                    <a id="kt_horizontal_search_advanced_link" class="btn btn-link" data-bs-toggle="collapse"
                        href="#kt_advanced_search_form">Advanced Search</a>
                    <button type="reset" class="btn text-danger clear-btn">Clear</button>
                </div>
                <!--end:Action-->
            </div>
            <!--end::Compact form-->
            <!--begin::Advance form-->
            <div class="collapse" id="kt_advanced_search_form">
                <!--begin::Separator-->
                <div class="separator separator-dashed mt-9 mb-6"></div>
                <!--end::Separator-->
                <!--begin::Row-->
                <div class="row g-8 mb-8">
                    <!--begin::Col-->
                    <div class="col-md-6">
                        <label class="fs-6 form-label fw-bold text-dark">Client</label>
                        <select name="client_id" class="form-select" data-control="select2"
                            data-placeholder="Select an option">
                            <option value=""></option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ request()->query('client_id')==$user->id ?
                                'selected' :
                                '' }}>{{ ucwords($user->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6">
                        <label class="fs-6 form-label fw-bold text-dark">Notes</label>
                        <input type="text" class="form-control form-control-solid border" name="note"
                            value="{{ request()->query('notes') }}" placeholder="Enter Note..." />
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Advance form-->
        </div>
    </form>
    <!--end::Form-->
</div>
<!--end::filter-->
@endsection

@section('content')
<div class="container">
    <!--begin::Tables Widget 10-->
    <div class="card mb-5 mb-xl-8">
        @yield('filter')

        <!--begin::Body-->
        <div class="card-body pt-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="text-center">
                            <th class="col-4 p-3">Order</th>
                            <th class="col-4 p-3">Amount</th>
                            <th class="col-2 p-3">Products</th>
                            <th class="col-2 p-3">Actions</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @forelse ($orders as $order)
                        <tr>
                            <td class="text-center">
                                <span class="text-primary fw-bold"># {{ $order->order_number }}</span>
                            </td>
                            <td>
                                <div class="text-center">
                                    Sub Total: ${{ number_format($order->sub_total, 2)
                                    }}
                                    <br>
                                    Total: ${{ number_format($order->total, 2)
                                    }}
                                </div>
                            </td>
                            <td class="text-center">
                                {{ $order->products_count }}
                            </td>
                            <td class="d-flex justify-content-end border-0">
                                @can('orders.read')
                                <a href="{{ route('orders.show', $order->id) }}"
                                    class="btn btn-icon btn-primary btn-sm me-1">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                @endcan
                                @can('orders.delete')
                                <a href="{{ route('orders.destroy', $order->id) }}"
                                    class="btn btn-icon btn-danger btn-sm show_confirm" data-toggle="tooltip"
                                    data-original-title="Delete Order">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <th colspan="4">
                                <div class="text-center">No Orders Yet ...</div>
                            </th>
                        </tr>
                        @endforelse
                    </tbody>
                    <!--end::Table body-->

                    <tfoot>
                        <tr>
                            <th colspan="4">
                                {{ $orders->appends(['order_number' => request()->query('order_number'), 'client_id' =>
                                request()->query('client_id'), 'note' =>
                                request()->query('note')])->links() }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
        <!--begin::Body-->
    </div>
    <!--end::Tables Widget 10-->
</div>
@endsection
