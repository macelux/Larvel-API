@extends('adminlte::page')
@section('title') {{ 'Create Admin' }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-shopping-bag"></i> {{ 'Create Admin' }} </h1>
        </div>
    </div>
    
    <div class="row user">
        <div class="col-md-3">
            <div class="tile p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab">General</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <div class="tile">
                        <form action="{{ route('admin.admin.store') }}" method="POST" role="form">
                            @csrf
                            <h3 class="tile-title">Admin Information</h3>
                            <hr>
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="name">Name</label>
                                    <input
                                        class="form-control @error('name') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter attribute name"
                                        id="name"
                                        name="name"
                                        value="{{ old('name') }}"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('name') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="email">Email</label>
                                    <input
                                            class="form-control @error('email') is-invalid @enderror"
                                            type="text"
                                            placeholder="Enter attribute email"
                                            id="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('email') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="password">Password</label>
                                    <input
                                            class="form-control @error('password') is-invalid @enderror"
                                            type="text"
                                            placeholder="Enter attribute password"
                                            id="password"
                                            name="password"
                                            value="{{ old('password') }}"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('password') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="tile-footer">
                                <div class="row d-print-none mt-2">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Admin</button>
                                        <a class="btn btn-danger" href="{{ route('admins.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

