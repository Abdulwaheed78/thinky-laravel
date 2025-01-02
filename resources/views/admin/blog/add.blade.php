@extends('admin.includes.app')
@section('title')
    Thinky Blogs - Blog Add
@endsection

@section('content')

    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Blog Add</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ route('blog.index') }}">Blog</a></li>
                                <li class="active">Add</li>
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
                            <h4 class="card-title mb-0">Add Blog Basic Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('blog.create') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class=" col-sm-6 mb-3">
                                        <label for="name" class="form-label">Title</label>
                                        <input type="text" oninput="checkTitle(this.value)" class="form-control"
                                            id="name" name="title">
                                        <span class="text-danger" id="span-id"></span>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" class="form-control" id="image" name="image"
                                            accept="image/*">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label for="status" class="form-label">Status</label>
                                        <select class=" form-control form-select" id="status" name="status">
                                            <option value=""></option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label for="status" class="form-label">Nature</label>
                                        <select class=" form-control form-select" id="nature" name="nature">
                                            <option value=""></option>
                                            @foreach ($nature as $nature)
                                                <option value="{{ $nature['id'] }}">{{ $nature['name'] }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="status" class="form-label">Author</label>
                                        <select class=" form-control form-select" id="author" name="author">
                                            <option value=""></option>
                                            @foreach ($author as $author)
                                                <option value="{{ $author['id'] }}">{{ $author['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="tags" class="form-label">Tags</label><br>
                                        <select class=" form-control tags" id="tags" name="tag[]" multiple>
                                            <option value=""></option>
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag['id'] }}">{{ $tag['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="categories" class="form-label">Categories</label><br>
                                        <select class=" form-control categorys" id="categories" name="category[]" multiple>
                                            <option value=""></option>
                                            @foreach ($categorys as $category)
                                                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3 ">
                                    <div class="col-12">
                                        <label for="details" class="form-label">Details</label>
                                        <textarea name="detail" class="form-control" id="detail" cols="30" rows="4"></textarea>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('blog.index') }}" class="btn btn-secondary mr-2">Back</a>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script type="text/javascript">
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        function checkTitle(name) {
            jQuery.ajax({
                url: "{{ route('blog.check') }}",
                type: 'POST',
                data: {
                    name: name
                },
                success: function(response) {
                    if (response.status == 'true') {
                        jQuery("#span-id").text(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + ' ' + error);
                }
            });
        }
    </script>
    <script>
        jQuery(document).ready(function() {
            jQuery('#categories').select2();
            jQuery('#tags').select2();
        });
    </script>
@endsection
