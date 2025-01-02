<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.png') }}">

    <meta name="description" content />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/flaticon/font/flaticon.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('frontend/css/tiny-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/flatpickr.min.css') }}">

    <title>@yield('title')</title>
</head>

<body>
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close">
                <span class="icofont-close js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <nav class="site-nav">
        <div class="container">
            <div class="menu-bg-wrap">
                <div class="site-navigation">
                    <div class="row g-0 align-items-center">
                        <div class="col-2">
                            <a href="{{ route('index') }}" class="logo m-0 float-start"><img
                                    src="{{ asset('backend/images/logo.png') }}" alt="Not Found" height="50px"></a>
                        </div>
                        <div class="col-8 text-center">
                            <form action="#" class="search-form d-inline-block d-lg-none">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="bi-search"></span>
                            </form>

                            <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu mx-auto">
                                <li><a href="{{ route('index') }}">Home</a></li>
                                <li><a href="{{ route('blog.list') }}">Blogs</a></li>
                                <li><a href="{{ route('about') }}">About</a></li>
                                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                {{-- <li><a href="{{ route('login') }}">Login</a></li> --}}
                            </ul>
                        </div>
                        <div class="col-2 text-end">
                            <a href="#"
                                class="burger ms-auto float-end site-menu-toggle js-menu-toggle d-inline-block d-lg-none light">
                                <span></span>
                            </a>

                            <form action="{{ route('blog.search') }}" method="GET"
                                class="search-form d-none d-lg-inline-block">
                                <input type="text" class="form-control" name="search" placeholder="Search...">
                                <button type="submit" class="btn btn-link p-0">
                                    <i class="flaticon-search"></i>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')


    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="widget">
                        <h3 class="mb-4">About</h3>
                        <p>Far far away, behind the word mountains, far from the countries
                            Vokalia and Consonantia, there live the blind texts.</p>
                    </div> <!-- /.widget -->

                </div> <!-- /.col-lg-4 -->

                <div class="col-lg-4">
                    <div class="widget">
                        <h3 class="mb-4">Company</h3>
                        <ul class="list-unstyled float-start links">
                            <li><a href="{{ route('index') }}">Home</a></li>
                            <li><a href="{{ route('about') }}">About us</a></li>
                            <li><a href="{{ route('contact') }}">Contact us</a></li>
                        </ul>
                        <ul class="list-unstyled float-start links">
                            <li><a href="{{ route('blog.list') }}">Blogs</a></li>
                            <li><a href="{{ route('login') }}">Admin Login</a></li>
                        </ul>
                    </div> <!-- /.widget -->
                </div>

                <div class="col-lg-4">
                    <div class="widget">
                        <h3 class="mb-4">Recent Post Entry</h3>
                        <div class="post-entry-footer">
                            <ul>
                                @if (isset($recentBlogs) && $recentBlogs->isNotEmpty())
                                    <ul>
                                        @foreach ($recentBlogs as $blog)
                                            <li>
                                                <a href="{{ route('single.single', $blog->title) }}">
                                                    <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('frontend/images/blog.png') }}"
                                                        alt="Image placeholder" class="me-4 rounded">
                                                    <div class="text">
                                                        <h4>{{ $blog->title }}</h4>
                                                        <div class="post-meta">
                                                            <span
                                                                class="mr-2">{{ $blog->created_at->format('M d Y') }}</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>No recent blogs available.</p>
                                @endif


                            </ul>
                        </div>

                    </div> <!-- /.widget -->
                </div> <!-- /.col-lg-4 -->
            </div> <!-- /.row -->

            <div class="row mt-5">
                <div class="col-12 text-center">
                    <p>Devloped and Designed By <a href="https://abdulwaheed78.github.io/">Abdul Waheed Chaudhary</a></p>
                </div>
            </div>
        </div> <!-- /.container -->
    </footer> <!-- /.site-footer -->

    <!-- Preloader -->
    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('frontend/js/flatpickr.min.js') }}"></script>
    <script src="{{ asset('frontend/js/aos.js') }}"></script>
    <script src="{{ asset('frontend/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/js/navbar.js') }}"></script>
    <script src="{{ asset('frontend/js/counter.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>

</body>

</html>
