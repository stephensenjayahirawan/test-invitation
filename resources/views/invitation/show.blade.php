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
                            <form action="{{ route('invitations-update',$invitation->token) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <label for="name">Name</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $invitation->name }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="email" id="email" value="{{ $invitation->email }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <label for="email">Token</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="email" id="email" value="{{ $invitation->token }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <label for="status">Status</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <span class="badge bg-{{ $invitation->status == 1 ? 'warning' : 'primary' }}">{{ $invitation->status == 1 ? 'Not Registered yet' : 'Registered' }}</span>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <label for="status">Created By </label>
                                    </div>
                                    <div class="col-sm-9">
                                        <span class="badge bg-primary">{{ $invitation->owner->name }}</span>
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
