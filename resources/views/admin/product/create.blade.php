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
                                {{ __('Add Product') }}
                            </div>
                            <div class="col-md-6 text-right">
                                <a class="btn btn-primary btn-sm " href="{{ route('product.index') }}">Back</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category" class="form-control" required>
                                    @if(!$categories->isEmpty())
                                        <option>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    @else
                                        <option>No Category Found!</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Rent</label>
                                <input type="text" name="rent" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Refundable Deposit</label>
                                <input type="text" name="deposit" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Select Size</label>
                                <select class="form-control" name="size[]" multiple>
                                    <option disabled>Select Size</option>
                                    <option value="6*4">(6*4)</option>
                                    <option value="6*5">(6*5)</option>
                                    <option value="6*6">(6*6)</option>
                                    <option value="6*7">(6*7)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Details</label>
                                <textarea class="form-control" name="details" required rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary ">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
