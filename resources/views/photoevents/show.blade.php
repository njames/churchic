@extends('app')

@section('htmlheader_title')
    Photo Event :: {{ $photoEvent->name }}
@endsection

@section('contentheader_title')
    Photo Event :: {{ $photoEvent->name }}
@endsection

@section('PhotoEvents-active')
    class="active"
@stop


@section('header-scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css" >
@stop


@section('main-content')
<div class="container">


    <h3>Download Template</h3>
    <a href="/templates/photo_event_template.csv" target="_blank">Spreadsheet Template</a>

    <h3>Upload Spreadsheet</h3>

    {!! Form::open(['url' => route('PhotoEvents.loadExcel'), 'method' => 'POST' ]) !!}

        {!! Form::label( 'spreadsheet', 'Choose your Spreadsheet') !!}
        {!! Form::file('spreadsheet') !!}


        {!! Form::submit('Upload Excel', ['class' => 'btn btn-primary' ]) !!}

    {!! Form::close() !!}

</div>

<hr>

    <h3>Upload Photos</h3>

<form action="{{ route('PhotoEvents.loadPhoto') }}" method="POST" class="dropzone">

    {{ csrf_field() }}

    <input name="id" value="{{ $photoEvent->id }}" hidden="hidden"  />

    <div class="fallback form-group">
        <input name="file" type="file" multiple />
        {!! Form::submit('Upload Photos', ['class' => 'btn btn-primary' ]) !!}
    </div>

</form>

@stop


@section('footer-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
@stop