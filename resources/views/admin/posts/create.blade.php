@extends('layouts.admin')

    @section('title')
        Create Post
    @endsection

    @section('content')
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
{{--        todo preuzmi fajlove za tiny jer ovo sa neta sporo ucitava--}}
        <x-tiny></x-tiny>
        {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true]) !!}
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
                <textarea name="content" id="content"></textarea>
            </div>

            <div class="form-group">
                {!! Form::label('published_at', 'To be published at:') !!}
                {!! Form::datetimeLocal('published_at', now('Europe/Belgrade'), ['class'=>'form-control col-4', 'min'=>now('Europe/Belgrade')->format('Y-m-d\TH:i')]) !!}
            </div>

            <br>
                {!! Form::submit('Create Post', ['class'=>'btn btn-primary col-4']) !!}
        {!! Form::close() !!}
        <br>
    @endsection
