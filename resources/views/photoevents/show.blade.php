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
	<div class="row">

        {{ $photoEvent->name }}


    </div>
</div>

<hr>

<form action="{{ route('PhotoEvents.loadPhoto') }}" method="POST" class="dropzone">

    {{ csrf_field() }}

    <input name="id" value="{{ $photoEvent->id }}" hidden="hidden"  />

    <div class="fallback form-group">
        <input name="file" type="file" multiple />
        {!! Form::submit('Upload Files', ['class' => 'btn btn-primary' ]) !!}
    </div>

</form>

@stop


@section('footer-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
@stop