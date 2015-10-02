@extends('app')

@section('htmlheader_title')
    Upload Files
@stop

@section('header-scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css" >
@stop


@section('contentheader_title')
    Upload Files
@stop



@section('main-content')

    <form action="{{ route('upload.store') }}" method="POST" class="dropzone">
        
        {{ csrf_field() }}

        <div class="fallback form-group">
            <input name="file" type="file" multiple />
            {!! Form::submit('Upload Files', ['class' => 'btn btn-primary' ]) !!}
        </div>

    </form>

@stop


@section('footer-scripts')
    <script scr="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
@stop