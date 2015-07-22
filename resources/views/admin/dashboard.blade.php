@extends('admin')

@section('title')Admin Dashboard @endsection
@section('description')Admin Dashboard @endsection
@section('content')
        <div class="container-fluid main-container">
            <div class="col-md-2 sidebar">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="{{ url('/admin') }}">Dashboard</a></li>
                    <li><a href="{{ url('/admin/content') }}">Content</a></li>
                    <li><a href="{{ url('/admin/categories') }}">Categories</a></li>
                    <li><a href="{{ url('/admin/tags') }}">Tags</a></li>                    
                </ul>
            </div>
            <div class="col-md-10 content">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Dashboard
                    </div>
                    <div class="panel-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('footer_scripts')
    
@endsection

