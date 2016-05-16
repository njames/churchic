@extends('spark::layouts.app')

@section('content')
<home :user="user" inline-template>

    <div class="container">
        <!-- Application Dashboard -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Integrations</div>

                    <div class="panel-body">
                        Welcome to Integrations Home
                    </div>
                </div>
            </div>
        </div>
    </div>
</home>
@endsection
