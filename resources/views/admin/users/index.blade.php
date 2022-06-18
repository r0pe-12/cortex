@extends('layouts.admin')

    @section('title')
        All Users
    @endsection

    @section('content')
        <div class="row">

        @foreach($users as $user)
            <div class="col-lg-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-info">
                    <h3 class="widget-user-username">{{ $user->name }}</h3>
                    <h5 class="widget-user-desc">{{ $user->admin ? 'Admin' : 'User' }}</h5>
                </div>
                <a href="{{ route('admin.users.edit', $user) }}">
                    <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="{{ $user->picture }}" alt="User Avatar">
                    </div>
                </a>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-4 offset-4 border-left border-right">
                            <a href="{{ route('admin.users.posts', $user) }}">
                                <div class="description-block">
                                    <h5 class="description-header">{{ count($user->posts) }}</h5>
                                    <span class="description-text">Posts</span>
                                </div>
                            <!-- /.description-block -->
                            </a>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
        @endforeach
        </div>
    @endsection
