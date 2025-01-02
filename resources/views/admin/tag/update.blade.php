@extends('admin.includes.app')
@section('title')
    Thinky Blogs - Tag Update
@endsection

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Tag Update</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ route('tag.index') }}">Tag</a></li>
                                <li class="active">Update</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card w-100">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Update Tag</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('tag.update', $data['id']) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" value="{{ $data['name'] }}" class="form-control"
                                            id="name" name="name" placeholder="Enter Tag name">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" class="form-control" id="image" name="image"
                                            accept="image/*">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="status" class="form-label">Status</label>
                                        <select class=" form-control form-select" id="status" name="status">
                                            <option value=""></option>
                                            <option value="active" @if ($data['status'] == 'active') selected @endif>Active
                                            </option>
                                            <option value="inactive" @if ($data['status'] == 'inactive') selected @endif>
                                                Inactive</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="{{ asset('storage/' . $data['image']) }}" alt="Not Found" height="120px"
                                            width="120px">

                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('tag.index') }}" class="btn btn-secondary mr-2">Back</a>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
    </div><!-- .content -->
@endsection
