@extends('layouts.public')

    @section('header')
        <header class="masthead" style="background-image: url({{ asset('startbootstrap/assets/blurry-gradient-haikei.svg') }})">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1>{{ $post->title }}</h1>
                            <h2 class="subheading">{{ $post->short_description }}</h2>
                            <span class="meta">
                                Posted by
                                <a href="#!">{{ $post->user->name }}</a>
                                {{ $post->published_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    @endsection

    @section('content')
        <article class="mb-4">
            <div class="container px-4 px-lg-5">

                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        @if($post->getAttributes()['picture'])
                            <img src="{{ $post->picture }}" alt="" class="img-fluid rounded-3">
                        @endif
                    <br>
                        {!! $post->content !!}
                    </div>
                </div>
            </div>
        </article>
        @can('update', $post)
            <hr>
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7 text-center">
                        <a href="{{ route('admin.posts.edit', $post) }}">Edit this post right here</a>
                    </div>
                </div>
            </div>
        @endcan
    @endsection
