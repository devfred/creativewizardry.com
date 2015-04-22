@extends('app')
@section('title')Contact @endsection
@section('content')
    <h2 class="page-title">Contact Me</h2>
	<form class="form-horizontal" role="form" method="POST" action="{{ url('/contact') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label class="col-md-3 control-label">Name</label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="name" value="{{ old('name') }}">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">E-Mail Address</label>
			<div class="col-md-8">
				<input type="email" class="form-control" name="email" value="{{ old('email') }}">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label">Message</label>
			<div class="col-md-8">
				<textarea class="form-control" name="message" rows="5">{{ old('message') }}</textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-8 col-md-offset-3">
				<button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Contact</button>
			</div>							
		</div>
	</form>	
@endsection
