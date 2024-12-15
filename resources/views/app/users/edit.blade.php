@extends('app.layouts.app')

@section('title', 'users')

@section('actions')
<a href="{{ url()->previous() }}" class="btn btn-sm fw-bold btn-secondary">
    Back
</a>
@endsection

@section('content')
<div class="card">
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="form">
        @csrf

        <div class="card-head pt-10">
            <h1 class="text-center text-primary">Edit User</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="required form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name..."
                            value="{{ $user->name }}" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="required form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email..."
                            value="{{ $user->email }}" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" name="phone" placeholder="Enter Phone Number..."
                            value="{{ $user->phone }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" placeholder="Enter Address..."
                            value="{{ $user->address }}" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group my-10">
                        <h3>Permissions</h3>

                        @php
                        $groupedPermissions = $permissions->groupBy(function($permission) {
                        return explode('.', $permission->name)[0];
                        });
                        @endphp

                        <div class="row">
                            @foreach($groupedPermissions as $category => $categoryPermissions)
                            <div class="col-md-6 my-3">
                                <h6 class="my-3">{{ ucfirst($category) }}</h6>
                                <div class="d-flex gap-2">
                                    @foreach($categoryPermissions as $permission)
                                    <label class="mx-1">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{
                                            in_array($permission->name, $userPermissions) ? 'checked' : '' }}>
                                        {{ ucfirst(explode('.', $permission->name)[1]) }}
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
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
@endsection