@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="{{ route('invitations') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <label for="name">Name <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <label for="email">Email <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <label for="sku">Role <span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select name="role" id="role" class="form-control" required>
                                            @can('create-invitation')
                                            <option value="">--- Select One ---</option>
                                            <option value="admin">Admin</option>
                                            @endcan
                                            <option value="manager">Ratailer Manager</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-12 text-center">
                                        <input type="submit" class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
