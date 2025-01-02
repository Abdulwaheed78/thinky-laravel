@extends('includes.app')
@section('title')
@endsection
@section('content')
    <section class="section">
        <div class="container">

            <div class="row mb-4">
                <h2 class="posts-entry-title">Popular Blogs</h2>
            </div>

            <div class="row">
                @if (count($popular_blogs) > 0)
                    @foreach ($popular_blogs as $pdata)
                        <div class="col-lg-4 mb-4">
                            <div class="post-entry-alt">
                                <img src="{{ $pdata->image ? asset('storage/' . $pdata->image) : asset('frontend/images/blog.png') }}"
                                    onclick="location.href='{{ route('single.single', ['title' => $pdata->title]) }}'"
                                    alt="No Image" class="img-fluid" style="height:250px;width:400px;cursor:pointer;">

                                <h5 class="mt-2"><a
                                        href="{{ route('single.single', ['title' => $pdata->title]) }}">{{ $pdata->title }}</a>
                                </h5>
                                <div class="post-meta align-items-center text-left clearfix">
                                    <figure class="author-figure mb-0 me-3 float-start"><img
                                            src="{{ $pdata->author->image ? asset('storage/' . $pdata->author->image) : asset('frontend/images/user.png') }}"
                                            alt="Image" class="img-fluid"></figure>
                                    <span class="d-inline-block mt-1">By <a
                                            href="#">{{ $pdata->author->name }}</a></span>
                                    <span>{{ date('M d Y', strtotime($pdata->created_at)) }}</span>
                                </div>
                                <p style="overflow:hidden;">{{ substr($pdata->detail, 0, 50) }}</p>
                                <p><a href="{{ route('single.single', ['title' => $pdata->title]) }}"
                                        class="read-more">Continue
                                        Reading</a></p>

                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">

            <div class="row mb-4">
                <h2 class="posts-entry-title">Recent Blogs</h2>
            </div>

            <div class="row">
                @foreach ($data as $data)
                    <div class="col-lg-4 mb-4">
                        <div class="post-entry-alt">
                            <a href="#" class="img-link">
                                <img src="{{ $data->image ? asset('storage/' . $data->image) : asset('frontend/images/blog.png') }}"
                                    onclick="location.href='{{ route('single.single', ['title' => $data->title]) }}'"
                                    alt="No Image" class="img-fluid" style="cursor:pointer;">

                            </a>

                            <h5 class="mt-2"><a
                                    href="{{ route('single.single', ['title' => $data->title]) }}">{{ $data->title }}</a>
                            </h5>
                            <div class="post-meta align-items-center text-left clearfix">
                                <figure class="author-figure mb-0 me-3 float-start"><img
                                        src="{{ $data->author->image ? asset('storage/' . $data->author->image) : asset('frontend/images/user.png') }}"
                                        alt="Image" class="img-fluid"></figure>
                                <span class="d-inline-block mt-1">By <a href="#">{{ $data->author->name }}</a></span>
                                <span>{{ date('M d Y', strtotime($data->created_at)) }}</span>
                            </div>
                            <p style="overflow:hidden;">{{ substr($data->detail, 0, 50) }}</p>
                            <p><a href="{{ route('single.single', ['title' => $data->title]) }}" class="read-more">Continue
                                    Reading</a></p>

                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mb-4">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6 text-sm-end"><a href="{{ route('blog.list') }}" class="read-more">View All</a></div>
            </div>
        </div>
    </section>
@endsection
