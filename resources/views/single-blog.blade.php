@extends('includes.app')

@section('title')
    Blog Detail
@endsection
@section('content')

    <div class="site-cover site-cover-sm same-height overlay single-page"
        style="background-image: url('{{ $data->image ? asset('storage/' . $data->image) : asset('frontend/images/blog.png') }}'); background-size: cover; background-position: center center;">
        <div class="container">
            <div class="row same-height justify-content-center">
                <div class="col-md-6">
                    <div class="post-entry text-center">
                        <h1 class="mb-4">{{ $data->title }}</h1>
                        <div class="post-meta align-items-center text-center">
                            <figure class="author-figure mb-0 me-3 d-inline-block">
                                <img src="{{ $data->author->image ? asset('storage/' . $data->author->image) : asset('frontend/images/user.png') }}"
                                    alt="Image" class="img-fluid">
                            </figure>
                            <span class="d-inline-block mt-1">By {{ $data->author->name }}</span>
                            <span>&nbsp;-&nbsp; {{ $data->created_at->format('d M Y h:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="section">
        <div class="container">

            <div class="row blog-entries element-animate">

                <div class="col-md-12 col-lg-8 main-content">

                    <div class="post-content-body" style="overflow: hidden;">
                        {{ strip_tags($data->detail) }}
                        </p>
                    </div>
                    <div class="pt-5">
                        <p>Categories:
                            @foreach ($categorys as $categorys)
                                @foreach ($data->categories as $dcat)
                                    @if ($categorys->id == $dcat->category_id)
                                        <a href="#">{{ $categorys->name }}</a>,
                                    @endif
                                @endforeach
                            @endforeach

                            Tags: @foreach ($tags as $tags)
                                @foreach ($data->tags as $dtag)
                                    @if ($tags->id == $dtag->tag_id)
                                        <a href="#">{{ $tags->name }}</a>,
                                    @endif
                                @endforeach
                            @endforeach
                        </p>
                    </div>

                    <div class="pt-5 comment-wrap">
                        <h3 class="mb-5 heading">6 Comments</h3>
                        <ul class="comment-list">

                            @foreach ($data->comment->sortByDesc('created_at') as $index => $comment)
                                <li class="comment">
                                    <div class="vcard">
                                        <img src="{{ asset('frontend/images/user.png') }}" alt="Image placeholder">
                                    </div>
                                    <div class="comment-body">
                                        <h3>{{ $comment->name }}</h3>
                                        <div class="meta">{{ date('M d Y h:i A', strtotime($comment->created_at)) }}
                                        </div>
                                        <p style="overflow:hidden;">{{ $comment->detail }}</p>
                                        {{-- <p><a href="#" class="reply rounded">Reply</a></p> --}}
                                    </div>
                                </li>
                            @endforeach

                        </ul>

                        <div class="comment-form-wrap pt-5">
                            <h3 class="mb-5">Leave a comment</h3>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">
                                    <p>{{ session('success') }}</p>
                                </div>
                            @endif

                            <form action="{{ route('comment.submit') }}" method="POST" class="p-5 bg-light">
                                <input type="hidden" name="user" value="{{ $data->id }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name *</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message" cols="30" rows="10" required class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Post Comment" required class="btn btn-primary">
                                </div>

                            </form>
                        </div>

                    </div>

                </div>

                <div class="col-md-12 col-lg-4 sidebar">

                    <div class="sidebar-box">
                        <div class="bio text-center">
                            <img src="{{ $data->author->image ? asset('storage/' . $data->author->image) : asset('frontend/images/user.png') }}"
                                alt="Author" class="img-fluid mb-3">
                            <div class="bio-body">
                                <h2>{{ $data->author->name }}</h2>
                                <p class="mb-4" style="overflow: hidden;">
                                <p>{!! $data->author->detail !!}</p> .</p>
                                <p class="btn btn-primary btn-sm rounded px-2 py-2">About Author</p>
                            </div>
                        </div>
                    </div>


                    <div class="sidebar-box">
                        <h3 class="heading">Popular Blog Posts</h3>
                        <div class="post-entry-sidebar">
                            <ul>

                                @if (count($popular_blogs) > 0)
                                    @foreach ($popular_blogs as $pdata)
                                        <li>
                                            <a href="{{ route('single.single', $pdata->title) }}">
                                                <img src="{{ $pdata->image ? asset('storage/' . $pdata->image) : asset('frontend/images/blog.png') }}" alt="Image placeholder" class="me-4 rounded">
                                                <div class="text">
                                                    <h4>{{ $pdata->title }}</h4>
                                                    <div class="post-meta">
                                                        <span
                                                            class="mr-2">{{ $pdata->created_at->format('d M Y') }}</span>
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
    </section>


    <!-- Start posts-entry -->
    <section class="section posts-entry posts-entry-sm bg-light">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-uppercase text-black">More Blog Posts</div>
            </div>
            <div class="row">

                @if (count($related) > 0)
                    @foreach ($related as $index => $data)
                        <div class="col-md-6 col-lg-3">
                            <div class="blog-entry">
                                <a href="{{ route('single.single', $data->title) }}" class="img-link">
                                    <img src="{{ $data->image ? asset('storage/' . $data->image) : asset('frontend/images/blog.png') }}"
                                        alt="Image" class="img-fluid">
                                </a>
                                <span class="date">{{ $data->created_at->format('d M Y') }}</span>
                                <h2><a href="{{ route('single.single', $data->title) }}">{{ $data->title }}</a></h2>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                <p><a href="{{ route('single.single', $data->title) }}" class="read-more">Continue
                                        Reading</a></p>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>
    <!-- End posts-entry -->

@endsection
@section('js')
@endsection
