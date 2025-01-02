@extends('includes.app')

@section('title')
    Blogs
@endsection
@section('content')
    <div class="hero overlay inner-page bg-primary py-5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center pt-5">
                <div class="col-lg-6">
                    <h1 class="heading text-white mb-3" data-aos="fade-up">Blogs</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="section search-result-wrap">
        <div class="container">

            <div class="row posts-entry">
                <div class="col-lg-8">
                    @foreach ($data as $index => $blog)
                        <div class="blog-entry d-flex gap-3 blog-entry-search-item">
                            <a href="#" class="img-link">
                                <img onclick="location.href='{{ route('single.single', $blog->title) }}'"
                                    src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('frontend/images/blog.png') }}"
                                    alt="No Image" class="img-fluid" style="cursor:pointer;">

                            </a>

                            <div style="overflow: hidden;">
                                <span class="date">{{ $blog->created_at->format('d M Y h:i A') }} &bullet;
                                    <a href="#">{{ $blog->nature->name }}</a>
                                </span>
                                <h2><a href="{{ route('single.single', $blog->title) }}">{{ $blog->title }}</a></h2>
                                <p>
                                    {{ \Illuminate\Support\Str::limit(strip_tags($blog->detail), 100, '...') }}</p>
                                <p><a href="{{ route('single.single', $blog->title) }}"
                                        class="btn btn-sm btn-outline-primary">Read More</a></p>
                            </div>
                        </div>
                    @endforeach


                    <div class="text-center">
                        {{ $data->links() }}
                    </div>
                </div>

                <div class="col-lg-4 sidebar">
                    <div class="sidebar-box search-form-wrap ">
                        <form action="{{ route('blog.search') }}" method="GET" class="sidebar-search-form d-flex">
                            <input type="text" class="form-control me-2" name="search"
                                value="{{ isset($search) ? $search : '' }}" id="s" placeholder="Type a keyword">
                            <button type="submit" style="height:54px;" class="btn btn-primary"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                </svg></button>
                        </form>

                    </div>


                    {{-- only this is remaining --}}
                    <div class="sidebar-box">
                        <h3 class="heading">Popular Posts</h3>
                        <div class="post-entry-sidebar">
                            <ul>

                                @if (count($popular_blogs) > 0)
                                    @foreach ($popular_blogs as $index => $popularBlog)
                                        <li>
                                            <a href="{{ route('single.single', $popularBlog->title) }}">
                                                <img src="{{ $popularBlog->image ? asset('storage/' . $popularBlog->image) : asset('frontend/images/blog.png') }}" alt="No Image"
                                                    class="me-4 rounded">
                                                <div class="text">
                                                    <h4>{{ $popularBlog->title }}</h4>
                                                    <div class="post-meta">
                                                        <span
                                                            class="mr-2">{{ $popularBlog->created_at->format('d M Y h:i A') }}</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif

                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
