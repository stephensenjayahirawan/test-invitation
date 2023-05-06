@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            @can('create-product')
                                
                            <a href="{{ route('create-product') }}" class="btn btn-primary">Create  </a>
                            @endcan
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
                                            <form action="{{route('products')}}">
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
                                                        <input type="text" class="form-control" name="sku" value="{{Request::get('sku')}}">
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
                                    <th scope="col" >Name</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col" >Description</th>
                                    @if(Auth::user()->role == 'admin')
                                    <th scope="col" >Manager Name</th>
                                    @endif
                                    <th scope="col" colspan="2" width="5%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $key => $product)
                                        <tr>
                                            <th scope="row">{{ $products->firstItem() + $key }}</th>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->sku }}</td>
                                            <td>{{ $product->description }}</td>
                                            @if(Auth::user()->role == 'admin')
                                                <td>{{ $product->owner->name }}</td>
                                            @endif
                                            <td>
                                                <a href="{{ route('products-detail', $product->sku) }}" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></a>
                                            </td>
                                            <td>
                                                @can('delete-product', $product)
                                                    <form action="{{ route('products-delete', $product->sku )}}" confirm="Are You Sure to Delete Product with SKU ({{$product->sku}}?)" method="POST">
                                                        @csrf   
                                                        @method('DELETE')
                                                        <button href="{{ route('products-detail', $product->sku) }}" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                
                            <div class="d-flex justify-content-center">
                                {!! $products->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
