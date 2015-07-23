@extends('admin')
@section('content')
    <p><a href="{{ url('/admin') }}">Admin Dashboard</a></p>
    <h2 class="page-title">Edit Tag</h2>    
    <h3>Edit Tag</h3>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/tags/' . $item->id ) }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
            <label class="col-md-4 control-label">Title</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="name" value="{{ $item->name }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Slug</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="slug" value="{{ $item->slug }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </div>
    </form>
@endsection
@section('footer_scripts')
    
@endsection