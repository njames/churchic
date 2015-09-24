@extends('app')

@section('htmlheader_title')
    Upload Files
@endsection

@section('contentheader_title')
    Upload Files
@endsection



@section('main-content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">


                    <div class="dz-preview dz-file-preview">
                      <div class="dz-details">
                        <div class="dz-filename"><span data-dz-name></span></div>
                        <div class="dz-size" data-dz-size></div>
                        <img data-dz-thumbnail />
                      </div>
                      <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                      <div class="dz-success-mark"><span>✔</span></div>
                      <div class="dz-error-mark"><span>✘</span></div>
                      <div class="dz-error-message"><span data-dz-errormessage></span></div>
                    </div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
