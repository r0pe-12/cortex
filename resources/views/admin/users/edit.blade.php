@extends('layouts.admin')

@section('title')
    Edit User: "{{ $user->name }}"
@endsection

@section('content')
    <x-tiny></x-tiny>
    <div class="row">
        <div class="col-7 vert-div">
            {!! Form::model($user, ['method'=>'PUT', 'action'=>['AdminUsersController@update', $user], 'files'=>true]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                @error('name') <div class="text-danger"><sup>*</sup>{{ $message }}</div> @enderror
                {!! Form::text('name', null, ['class'=>$errors->has('name') ? 'form-control is-invalid' : 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('picture', 'Picture:') !!}
                {!! Form::file('picture', ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Email:') !!}
                @error('email') <div class="text-danger"><sup>*</sup>{{ $message }}</div> @enderror
                {!! Form::email('email', null, ['class'=>$errors->has('email') ? 'form-control is-invalid' : 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('about', 'About:') !!}
                @error('about') <div class="text-danger"><sup>*</sup>{{ $message }}</div> @enderror
                <textarea name="about" id="about">{{ $user->about }}</textarea>
            </div>

            <br>
            {!! Form::submit('Update User', ['class'=>'btn btn-outline-primary col-5 float-left']) !!}
            {!! Form::close() !!}

            @if(Auth::user()->can('delete', $user))
                <a href="#" data-toggle="modal" data-target="#deleteModal" class="btn btn-outline-danger col-5 float-right">Delete User</a>

                {{--delete user modal--}}
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">You are about to delete User: "{{ $user->name }}"</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body alert alert-danger">This action is not reversible. You are going to be new owner of their posts</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                                <form method="post" action="{{route('admin.users.destroy', $user)}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">DELETE</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
{{--        picture column--}}
        <div class="col-5">
            <img src="{{ $user->picture }}" alt="" class="img-fluid img-rounded">
            <br><br>
            @if($user->getAttributes()['picture'])
                <a href="#" data-toggle="modal" data-target="#deletePictureModal" class="btn btn-outline-danger col-12 float-right">Delete Users Picture</a>
                {{--    delete picture modal--}}
                <div class="modal fade" id="deletePictureModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">You are about to delete Picture for User: "{{ $user->name }}"</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body alert alert-danger">This action is not reversible</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                                <form method="post" action="{{route('admin.users.picture.destroy', $user->id)}}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">DELETE</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <br>
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
