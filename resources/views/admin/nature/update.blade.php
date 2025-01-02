@extends('admin.includes.app')
@section('title')
    Thinky Blogs - Nature Update
@endsection

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Nature Update</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ route('nature.index') }}">Nature</a></li>
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
                            <h4 class="card-title mb-0">Update Nature</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('nature.update', $data['id']) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" value="{{ $data['name'] }}" class="form-control"
                                            id="name" name="name" placeholder="Enter Nature name">
                                    </div>
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
                                </div>


                                <!-- Buttons -->
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('nature.index') }}" class="btn btn-secondary mr-2">Back</a>
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
