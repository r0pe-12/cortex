@extends('layouts.admin')

    @section('title')
        Edit Post: "{{ $post->title }}"
    @endsection

    @section('content')
        <x-tiny></x-tiny>
        <div class="row">
            <div class="col-7 vert-div">
                {!! Form::model($post, ['method'=>'PUT', 'action'=>['AdminPostsController@update', $post], 'files'=>true]) !!}
                <div class="form-group">
                    {!! Form::label('picture', 'Picture:') !!}
                    {!! Form::file('picture', ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('title', 'Title:') !!}
                    @error('title') <div class="text-danger"><sup>*</sup>{{ $message }}</div> @enderror
                    {!! Form::text('title', null, ['class'=>$errors->has('title') ? 'form-control is-invalid' : 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('short_description', 'Short Description') !!}
                    @error('short_description') <div class="text-danger"><sup>*</sup>{{ $message }}</div> @enderror
                    {!! Form::text('short_description', null, ['class'=>$errors->has('short_description') ? 'form-control is-invalid' : 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('content', 'Content:') !!}
                    @error('content') <div class="text-danger"><sup>*</sup>{{ $message }}</div> @enderror
                    <textarea name="content" id="content">{{ $post->content }}</textarea>
                </div>

                <div class="form-group">
                    <input type="checkbox" checked id="option" {{ Auth::user()->admin ? null : 'disabled' }}>
                    {!! Form::label('published_at', 'To be published at:') !!}
                    {!! Form::datetimeLocal('published_at', $post->published_at->format('Y-m-d\TH:i'), ['class'=>'form-control col-4', 'id'=>'time', 'min'=>now('Europe/Belgrade')->format('Y-m-d\TH:i'), 'disabled']) !!}
                </div>

                <br>
                {!! Form::submit('Update Post', ['class'=>'btn btn-outline-primary col-5 float-left']) !!}
                {!! Form::close() !!}
                <a href="#" data-toggle="modal" data-target="#deleteModal" class="btn btn-outline-danger col-5 float-right">Delete Post</a>
            </div>
            <div class="col-5">
                <br>
                <img src="{{ $post->picture }}" alt="" class="img-fluid img-rounded">
                <br><br>
                <a href="#" data-toggle="modal" data-target="#deletePictureModal" class="btn btn-outline-danger col-5 center">Delete Post Picture</a>

            </div>
        </div>
            <br>
        {{--delete post modal--}}
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">You are about to delete Post: "{{ $post->title }}"</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body alert alert-danger">This action is not reversible</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                        <form method="post" action="{{route('admin.posts.destroy', $post)}}" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    {{--    delete picture modal--}}
        <div class="modal fade" id="deletePictureModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">You are about to delete Picture for Post: "{{ $post->title }}"</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body alert alert-danger">This action is not reversible</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                        <form method="post" action="{{route('admin.posts.picture.destroy', $post->id)}}">
                            @csrf
                            <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
                $(document).ready(function () {
                $('#option').click(function () {

                    if (this.checked){
                        $('#time').each(function () {
                            this.disabled = true;
                        });
                    }else {
                        $('#time').each(function () {
                            this.disabled = false;
                        });
                    }

                });
            })
        </script>
    @endsection
