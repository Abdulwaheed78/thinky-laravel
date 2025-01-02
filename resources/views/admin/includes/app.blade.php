<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Thinky Blogs')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
    @yield('css')
    <style>
        .btn-success {
            background-color: #01C292;
            color: white;
        }

        .btn-success:hover {
            background-color: #01C292;
            /* Hover background color */
            box-shadow: 0px 4px 10px rgba(1, 194, 146, 0.4);
            /* Add a subtle shadow */
        }

        .btn-secondary {
            background-color: #292B35;
            color: white;
        }

        #weatherWidget .currentDesc {
            color: #ffffff !important;
        }

        .traffic-chart {
            min-height: 335px;
        }

        #flotPie1 {
            height: 150px;
        }

        #flotPie1 td {
            padding: 3px;
        }

        #flotPie1 table {
            top: 20px !important;
            right: -10px !important;
        }

        .chart-container {
            display: table;
            min-width: 270px;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        #flotLine5 {
            height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }

        #cellPaiChart {
            height: 160px;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.css" />

</head>

<body style="background-color: #e5eef1;">
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel" style="background-color:#000;">
        <nav class="navbar navbar-expand-sm navbar-default" style="background-color:#000;">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">

                    <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="{{ request()->routeIs('blog.index') ? 'active' : '' }}">
                        <a href="{{ route('blog.index') }}"> <i class="menu-icon ti-pencil-alt"></i>Blog </a>
                    </li>
                    <li class="{{ request()->routeIs('category.index') ? 'active' : '' }}">
                        <a href="{{ route('category.index') }}"> <i class="menu-icon ti-tag"></i>Category </a>
                    </li>
                    <li class="{{ request()->routeIs('tag.index') ? 'active' : '' }}">
                        <a href="{{ route('tag.index') }}"> <i class="menu-icon ti-bookmark"></i>Tags </a>
                    </li>
                    <li class="{{ request()->routeIs('nature.index') ? 'active' : '' }}">
                        <a href="{{ route('nature.index') }}"> <i class="menu-icon ti-wand"></i>Nature </a>
                    </li>
                    <li class="{{ request()->routeIs('stagename.index') ? 'active' : '' }}">
                        <a href="{{ route('stagename.index') }}"> <i class="menu-icon ti-flag"></i>Stage Name </a>
                    </li>
                    <li class="{{ request()->routeIs('author.index') ? 'active' : '' }}">
                        <a href="{{ route('author.index') }}"> <i class="menu-icon ti-user"></i>Author </a>
                    </li>
                    <li class="{{ request()->routeIs('subscribe.index') ? 'active' : '' }}">
                        <a href="{{ route('subscribe.index') }}"> <i class="menu-icon ti-bell"></i>Subscribers </a>
                    </li>
                    <li class="{{ request()->routeIs('newsletter.index') ? 'active' : '' }}">
                        <a href="{{ route('newsletter.index') }}"> <i class="menu-icon ti-email"></i>Newsletter </a>
                    </li>

                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img src="../backend/images/logo.png" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="backend/images/logo2.png"
                            alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">

                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="{{ asset('backend/images/admin.jpg') }}"
                                alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                            <a class="nav-link text-danger" href="{{ route('logout') }}"><i
                                    class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->

        @yield('content')

        <!-- /.content -->
        <div class="clearfix"></div>

        <footer class="site-footer">
            <div class="footer-inner">
                <div class="row justify-content-center">
                    <div class="col-12 text-center text-dark">
                        <span>Copyright &copy; 2024 Thinky Blogs</span> |
                        <span>Designed by <a href="https://abdulwaheed78.github.io">Abdul Waheed Chaudhary</a></span>
                    </div>
                </div>
            </div>
        </footer>

    </div>



    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.3.1/"
            }
        }
    </script>

    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph
        } from 'ckeditor5';

        ClassicEditor
            .create(document.querySelector('#detail'), {
                plugins: [Essentials, Bold, Italic, Font, Paragraph],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                ]
            })
            .then(editor => {
                editor.ui.view.editable.element.style.height = '500px';
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    @yield('js')

</body>

</html>
