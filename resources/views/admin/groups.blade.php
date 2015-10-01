@extends('app')

@section('htmlheader_title')
    Groups
@endsection

@section('contentheader_title')
    Groups List
@endsection

@section('main-content')
  <h1>Groups</h1>

  @foreach ($groups as $group)
    <group>
      <div class="body">
        <a href="{{ action('GroupsController@show', [$group->id]) }}">{{ $group->name }}</a>
      </div>
      <div class="body" > {{ $group->description }}</div>
    </group>

  @endforeach
@endsection