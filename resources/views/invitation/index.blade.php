@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <a href="{{ route('invitations-create') }}" class="btn btn-primary">Create  </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Filter
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <form action="{{route('invitations')}}">
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        Name
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="name" value="{{Request::get('name')}}">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        SKU
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="email" value="{{Request::get('email')}}">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-12 text-center">
                                                        <button class="btn btn-secondary">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col" width="1%">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" width="5%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($invitations as $key => $invitation)
                                        <tr>
                                            <th scope="row">{{ $invitations->firstItem() + $key }}</th>
                                            <td>{{ $invitation->name }}</td>
                                            <td>{{ $invitation->email }}</td>
                                            <td>{{ $invitation->role }}</td>
                                            <td><span class="badge bg-{{ $invitation->status == 1 ? 'warning' : 'primary' }}">{{ $invitation->status == 1 ? 'Not Registered yet' : 'Registered' }}</span></td>
                                            <td><a href="{{ route('invitations-detail', $invitation->token) }}" class="btn btn-sm btn-primary"><i class="fa fa-search"></i>
                                            </a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                
                            <div class="d-flex">
                                {!! $invitations->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
