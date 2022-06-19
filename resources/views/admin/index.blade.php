@extends('layouts.admin')

    @section('title')
        Dashboard
    @endsection

    @section('header')
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ \App\Models\Post::count() }}</h3>

                        <p>Posts</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    @if(Auth::user()->admin)
                        <a href="{{ route('admin.posts.index') }}" class="small-box-footer">
                            View all <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ count(Auth::user()->posts) }}</h3>

                        <p>Posts you own</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book-reader"></i>
                    </div>
                    @if(Auth::user()->admin)
                        <a href="{{ route('admin.posts.create') }}" class="small-box-footer">
                            Create one <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    @else
                        <a href="{{ route('admin.posts.index') }}" class="small-box-footer">
                            View them <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ \App\Models\User::count() }}</h3>

                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                    @if(Auth::user()->admin)
                        <a href="#" class="small-box-footer">
                            View all <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endsection
