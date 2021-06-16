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
                                {{ __('Edit Category') }}
                            </div>
                            <div class="col-md-6 text-right">
                                <a class="btn btn-primary btn-sm " href="{{ route('category.index') }}">Back</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('category.update',$category->id) }}" method="post" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ $category->name }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>About</label>
                                <input type="text" name="about" class="form-control" value="{{ $category->about }}">
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary ">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
