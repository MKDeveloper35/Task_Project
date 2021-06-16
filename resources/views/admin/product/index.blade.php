@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                @include('admin.layout.sidebar')
            </div>
            <div class="col-md-9">
                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                {{ __('Product') }}
                            </div>
                            <div class="col-md-6 text-right">
                                <a class="btn btn-primary btn-sm " href="{{ route('product.create') }}">Add Product</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Rent</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if(!$products->isEmpty())
                                @php
                                    $index=1;
                                @endphp
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $index }}</td>
                                        <td><img src="{{ asset('public/upload/product/'.$product->image) }}" style="height: 50px;"></td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->productCategory->name }}</td>
                                        <td>{{ $product->rent }}</td>
                                        <td>
                                            <div style="display: flex;">
                                                <a href="{{ route('product.edit',$product->id) }}" class="btn btn-primary btn-xs m-b-5 m-r-3 mr-2">Edit</a>
                                                <a href="{{ route('product.show',$product->id) }}" class="btn btn-info btn-xs m-b-5 m-r-3 mr-2">View</a>
                                                <form action="{{ route('product.destroy',$product->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-xs m-b-5 m-r-3">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $index++;
                                    @endphp
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">No Result Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
