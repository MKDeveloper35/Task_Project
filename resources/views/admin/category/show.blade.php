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
                                {{ __('View Category') }}
                            </div>
                            <div class="col-md-6 text-right">
                                <a class="btn btn-primary btn-sm " href="{{ route('category.index') }}">Back</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" disabled value="{{ $category->name }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>About</label>
                                <input type="text" disabled class="form-control" value="{{ $category->about }}">
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <br>
                                <img src="{{ asset('public/upload/category/'.$category->image) }}" style="height: 300px;">
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
