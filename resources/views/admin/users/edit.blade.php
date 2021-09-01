@extends('adminlte::page')
@section('title') {{ 'Edit User' }} @endsection
@section('styles')
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('backend/js/plugins/dropzone/dist/min/dropzone.min.css') }}"/> -->
     <link rel="stylesheet" href="/css/admin_custom.css">
@endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-shopping-bag"></i> {{ 'Edit User' }} </h1>
        </div>
    </div>

    <div class="col-md-9">
        <div class="tab-content">
            <div class="tab-pane active" id="general">
                <div class="tile">
                    <form action="{{ route('admin.users.update') }}" method="POST" role="form">
                        @csrf
                        <h3 class="tile-title">User Information</h3>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="first_name">	FirstName</label>
                                    <input
                                            class="form-control @error('first_name') is-invalid @enderror"
                                            type="text"
                                            placeholder="Enter user FirstName"
                                            id="first_name"
                                            name="first_name"
                                            value="{{ old('first_name', $User->first_name) }}"
                                    />
                                    <input type="hidden" name="user_id" value="{{$User->id}}">
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('first_name') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="last_name">	LastName</label>
                                    <input
                                            class="form-control @error('last_name') is-invalid @enderror"
                                            type="text"
                                            placeholder="Enter user LastName"
                                            id="last_name"
                                            name="last_name"
                                            value="{{ old('last_name', $User->last_name) }}"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('last_name') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="email">	email</label>
                                    <input
                                            class="form-control @error('email') is-invalid @enderror"
                                            type="text"
                                            placeholder="Enter user email"
                                            id="email"
                                            name="email"
                                            value="{{ old('email', $User->email) }}"                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('email') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="address">	address</label>
                                    <input
                                            class="form-control @error('address') is-invalid @enderror"
                                            type="text"
                                            placeholder="Enter user address"
                                            id="address"
                                            name="address"
                                            value="{{ old('address', $User->address) }}"                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('address') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="city">	city</label>
                                    <input
                                            class="form-control @error('city') is-invalid @enderror"
                                            type="text"
                                            placeholder="Enter user city"
                                            id="city"
                                            name="city"
                                            value="{{ old('	city', $User->city)}}"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('	city') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="country">	country</label>
                                    <input
                                            class="form-control @error('country') is-invalid @enderror"
                                            type="text"
                                            placeholder="Enter user country"
                                            id="country"
                                            name="country"
                                            value="{{ old('country', $User->country)}}"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('country') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tile-footer">
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right">
                                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update User</button>
                                    <a class="btn btn-danger" href="{{ route('users.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>




@endsection
