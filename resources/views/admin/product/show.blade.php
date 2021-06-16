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
                                {{ __('View Product') }}
                            </div>
                            <div class="col-md-6 text-right">
                                <a class="btn btn-primary btn-sm " href="{{ route('product.index') }}">Back</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category" class="form-control" disabled required>
                                    @if(!$categories->isEmpty())
                                        <option>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @if($product->category_id == $category->id) {{ 'selected' }}@endif>{{ $category->name }}</option>
                                        @endforeach
                                    @else
                                        <option>No Category Found!</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" disabled value="{{ $product->name }}" required>
                            </div>
                            <div class="form-group">
                                <label>Rent</label>
                                <input type="text" name="rent" class="form-control" disabled required value="{{ $product->rent }}">
                            </div>
                            <div class="form-group">
                                <label>Refundable Deposit</label>
                                <input type="text" name="deposit" class="form-control" disabled required value="{{ $product->deposit }}">
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <br>
                                <img src="{{ asset('public/upload/product/'.$product->image) }}" style="height: 400px;">
                            </div>

                            @php
                                $stag=json_decode($product->size);
                            @endphp

                            <div class="form-group">
                                <label>Select Size</label>
                                <select class="form-control" disabled name="size[]" multiple required>
                                    <option disabled>Select Size</option>
                                    <option value="6*4" @if(in_array('6*4',$stag)){{ 'selected' }}@endif>(6*4)</option>
                                    <option value="6*5" @if(in_array('6*5',$stag)){{ 'selected' }}@endif>(6*5)</option>
                                    <option value="6*6" @if(in_array('6*6',$stag)){{ 'selected' }}@endif>(6*6)</option>
                                    <option value="6*7" @if(in_array('6*7',$stag)){{ 'selected' }}@endif>(6*7)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Details</label>
                                <textarea class="form-control" name="details" disabled required rows="4">{{ $product->details }}</textarea>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
