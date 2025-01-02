@extends('includes.app')
@section('title')
    Admin Login
@endsection
@section('content')
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="images/logo.png" alt="">
                    </a>
                </div>
                <div class="login-form d-flex align-content-center justify-content-center flex-wrap">
                    <div class="card p-4 col-12 col-sm-6 col-md-4 mt-5 mb-5">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif


                        <form method="post" action="{{ route('login-check') }}">
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="email" required class="form-control" placeholder="Email">
                            </div>
                            @csrf
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" required class="form-control" placeholder="Password">
                            </div>
                            <div class="checkbox text-end">
                                <label class="pull-right">
                                    <a href="#">Forgotten Password?</a>
                                </label>
                            </div>
                            <div class="text-center pt-4">
                                <button type="submit" class="btn btn-primary btn-flat m-b-20 m-t-20">Sign in</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
