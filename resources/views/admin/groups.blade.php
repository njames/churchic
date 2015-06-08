@extends('app')

@section('content')
  <h1>Groups</h1>

  @foreach ($groups as $group)
    <group>
      <h2>
        <a href="{{ action('GroupsController@show', [$group->id]) }}">{{ $group->name }}</a>
      </h2>
      <div class="body" > {{ $group->description }}</div>
    </group>

  @endforeach
@endsection