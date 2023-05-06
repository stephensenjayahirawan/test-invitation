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
                            <div class="row ">
                                <div class="col-sm-4  ">
                                    <img id="display_image" class="img-fluid m-auto  d-block" src="{{ asset('assets/image/dummy.png')}}" alt="Product Image ">    
                                </div>
                                <div class="col-sm-8">

                                    <form action="{{ route('products') }}" method="POST" enctype="multipart/form-data">
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
                                                <label for="sku">SKU <span style="color: red">*</span></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="sku" id="sku" value="{{ old('sku') }}" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-sm-3">
                                                <label for="description">Description <span style="color: red">*</span></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <textarea name="description" id="description" cols="30" rows="5" class="form-control" required>{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-sm-3">
                                                <label for="name">Image <span style="color: red">*</span></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="form-control" id="image" type="file" accept="image/*" name="image" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-sm-12 text-center">
                                                <input type="submit" id="submit_button" class="btn btn-primary">
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
    </div>
</div>
@endsection
