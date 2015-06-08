@extends('app')

@section('content')
  <h1>Groups</h1>

    <group>
      <h2>
        <a href="#">{{ $group->name }}</a>
      </h2>
      <div class="body" > {{ $group->description }}</div>
    </group>

@endsection