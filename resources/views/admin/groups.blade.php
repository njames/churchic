@extends('app')

@section('content')
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