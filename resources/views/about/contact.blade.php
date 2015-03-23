@extends('app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Contact</div>
	<div class="panel-body">
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		@if(Session::has('message'))
		    <div class="alert alert-info">
		    	{{ Session::get('message') }}
		    </div>
		@endif

		<form class="form-horizontal" role="form" method="POST" action="{{ url('/contact') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="form-group">
				<label class="col-md-4 control-label">Name</label>
				<div class="col-md-6">
					<input type="text" class="form-control" name="name" value="{{ old('name') }}">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label">E-Mail Address</label>
				<div class="col-md-6">
					<input type="email" class="form-control" name="email" value="{{ old('email') }}">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label">Message</label>
				<div class="col-md-6">
					<textarea class="form-control" name="message">{{ old('message') }}</textarea>								
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<button type="submit" class="btn btn-primary">Login</button>
				</div>							
			</div>

		</form>
	</div>
</div>
@endsection
