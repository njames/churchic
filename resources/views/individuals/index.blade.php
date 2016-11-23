@extends('app')

@section('htmlheader_title')
    Load Individuals Type Change Spread Sheet
@endsection

@section('contentheader_title')
    Individuals Type Change
@endsection

@section('header-scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css" >
@stop


@section('main-content')

    <h3>Upload Spreadsheet</h3>

<form action="{{ route('updateType') }}" method="POST" class="dropzone">

    {{ csrf_field() }}

    <div class="fallback form-group">
        <input name="file" type="file"  />
        {!! Form::submit('Upload Spreadsheet', ['class' => 'btn btn-primary' ]) !!}
    </div>

</form>

@stop


@section('footer-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
@stop