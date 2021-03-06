@extends('layouts.admin')

@section('title')
    {{ $user->name }}'s Posts
@endsection

@section('content')
    @if(count($posts))
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Owner</th>
                            <th>Photo</th>
                            <th>Title</th>
                            <th>Published At</th>
                            <th>Updated At</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td><img src="{{ $post->picture }}" alt="" class="img-rounded" height="100px"></td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->published_at->diffForHumans() }}</td>
                                <td>{{ $post->updated_at->diffForHumans() }}</td>
                                <td><a href="{{ route('admin.posts.edit', $post) }}">Edit Post here</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Owner</th>
                            <th>Photo</th>
                            <th>Title</th>
                            <th>Published At</th>
                            <th>Updated At</th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        {{--laravel paginator--}}
        <div class="d-flex">
            <div class="mx-auto">
                {{$posts->links()}}
            </div>
        </div>
    @else
        <!-- small card -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ \App\Models\Post::count() }}</h3>

                <p>Posts</p>
            </div>
            <div class="icon">
                <i class="fas fa-book-open"></i>
            </div>
            <a href="{{ route('admin.posts.create') }}" class="small-box-footer">
                Create First One <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    @endif
@endsection
