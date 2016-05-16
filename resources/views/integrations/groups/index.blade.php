@extends('spark::layouts.app')

@section('content')
<home :user="user" inline-template>

    <div class="container">
        <h2>Group Listing</h2>
        <!-- Group listing -->
        <div class="table-responsive">

            <table  class="table">
                <thead>
                    <tr>
                        <th>Source</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Sync Members</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($groups as $group)
                <tr>
                      <td> {{ $group->group_source }} </td>
                      <td> <a href="/integrations/groups/{{ $group->group_id }}">{{ $group->name }}</a> </td>
                      <td> {{ $group->description }} </td>
                      <td> <input type="checkbox"></td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination"> {{ $groups->links() }} </div>

        </div>

    </div>
</home>
@endsection
