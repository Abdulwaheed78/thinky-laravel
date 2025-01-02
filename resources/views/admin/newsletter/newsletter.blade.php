@extends('admin.includes.app')
@section('title')
    Thinky Blogs - NewsLetter
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
                            <h1>NewsLetter</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">NewsLetter</a></li>
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
                            <strong class="card-title">Blog NewsLetter</strong>
                            {{-- <a href="{{ route('stagename.add') }}" class="btn btn-success btn-sm">Add +</a> --}}
                        </div>

                        <div class="card-body">
                            <table id="newsletter-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Emails</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $row['email'] }}</td>
                                            <td align="right">
                                                {{-- <a href="{{ route('stagename.edit', ['id' => $row['id']]) }}"
                                                    class="btn btn-outline-secondary btn-sm"><i class="fa fa-edit"></i></a> --}}

                                                <a href="{{ route('newsletter.delete', ['id' => $row['id']]) }}"
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
            $('#newsletter-table').DataTable();
        });
    </script>
@endsection
