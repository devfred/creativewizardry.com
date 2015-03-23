@extends('app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Home</div>
        <div class="panel-body">
            <div class="quote">{{ Inspiring::quote() }}</div>
        </div>
    </div>
@endsection