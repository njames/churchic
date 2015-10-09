@extends('app')

@section('htmlheader_title')
    Photo Events
@endsection

@section('contentheader_title')
    Photo Events
@endsection

@section('PhotoEvents-active')
    class="active"
@stop


@section('main-content')
<div class="container">
    <a href="{{ route('PhotoEvents.create') }}" class="btn btn-primary" type="submit">Create New  Photo Event</a>

    @foreach ($PhotoEvents as $PhotoEvent)
    <div><a href="{{ route('PhotoEvents.show', ['PhotoEvents' => $PhotoEvent->id]) }}">{{ $PhotoEvent->name }}</a></div>
    @endforeach

</div>
@endsection
