@extends('app')

@section('htmlheader_title')
    Create a new Photo Event
@endsection

@section('contentheader_title')
Create a new Photo Event
@endsection



@section('main-content')
<div class="container">
	<div class="row">

        <form action="{{ route('PhotoEvents.store') }}" method="POST">

            {{ csrf_field() }}

            <div class="form-group">
                <lable for="name">Event Name: </lable>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"/>
            </div>

            <div class="form-group">
                <input class="btn btn-primary" type="submit"/>
            </div>

        </form>

	</div>
</div>
@endsection
