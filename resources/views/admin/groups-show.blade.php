@extends('app')

@section('htmlheader_title')
    Groups
@endsection

@section('contentheader_title')
    Group Show
@endsection

@section('main-content')
  <h1>Groups</h1>

    <div>
      <h2>
        <a href="#">{{ $group->name }}</a>
      </h2>
      <div class="body" > {{ $group->description }}</div>
    </div>

@endsection