@extends('admin.includes.app')
@section('title')
    Thinky Blogs - Blogs
@endsection

@section('css')
    <link rel="stylesheet" href="backend/assets/css/lib/datatable/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Blogs</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Blogs</a></li>
                                <li class="active">Index</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong class="card-title">Blog Blogs</strong>
                            <a href="{{ route('blog.add') }}" class="btn btn-success btn-sm">Add +</a>
                        </div>

                        <div class="card-body">
                            <table id="blog-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Basic Info</th>
                                        <th>Author</th>
                                        <th>Nature</th>
                                        <th>Tags</th>
                                        <th>Categories</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td align="center"><img src="{{ asset('storage/' . $row['image']) }}"
                                                    alt="Not Found" height="80px" width="80px"></td>
                                            <td>
                                                {{ $row['title'] }}
                                            </td>
                                            <td>{{ $row->author->name }}</td>
                                            <td>{{ $row->nature->name }}</td>

                                            <td>
                                                <div class="d-flex flex-wrap gap-1">
                                                    @foreach ($row->tags as $rtag)
                                                        @foreach ($tags as $tag)
                                                            @if ($rtag->tag_id == $tag->id && $rtag->blog_id == $row->id)
                                                                <span
                                                                    class="badge badge-info mb-1">{{ $tag->name }}</span>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex flex-wrap gap-1">
                                                    @foreach ($row->categories as $rcat)
                                                        @foreach ($categorys as $cat)
                                                            @if ($rcat->category_id == $cat->id && $rcat->blog_id == $row->id)
                                                                <span
                                                                    class="badge badge-success mb-1">{{ $cat->name }}</span>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </div>
                                            </td>

                                            <td>
                                                {{ $row['status'] }}
                                            </td>
                                            <td align="right">
                                                <a href="{{ route('blog.edit', ['id' => $row['id']]) }}"
                                                    class="btn btn-outline-secondary btn-sm"><i class="fa fa-edit"></i></a>

                                                <a href="{{ route('blog.delete', ['id' => $row['id']]) }}"
                                                    class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection

@section('js')
    <script src="backend/assets/js/lib/data-table/datatables.min.js"></script>
    <script src="backend/assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="backend/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="backend/assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="backend/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="backend/assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="backend/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="backend/assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="backend/assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="backend/assets/js/init/datatables-init.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#blog-table').DataTable();
        });
    </script>
@endsection
