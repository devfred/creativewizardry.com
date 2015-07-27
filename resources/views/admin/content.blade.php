@extends('admin')

@section('title')Admin Dashboard @endsection
@section('description')Admin Dashboard @endsection

@section('content')
        <div class="container-fluid main-container">
            <div class="col-md-2 sidebar">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="{{ url('/admin') }}">Dashboard</a></li>
                    <li class="active"><a href="{{ url('/admin/content') }}">Content</a></li>
                    <li><a href="{{ url('/admin/categories') }}">Categories</a></li>
                    <li><a href="{{ url('/admin/tags') }}">Tags</a></li>                    
                </ul>
            </div>
            <div class="col-md-10 content">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Content Items
                    </div>
                    <div class="panel-body">
                        <a href="{{ URL::to('/admin/content/create') }}">Create New Content Item</a>
                        <table class="table table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Is Published</th>
                                    <th>Publish Date</th>
                                </tr>
                            </thead>                            
                            @foreach($contentItems as $item)
                            <tr>
                                <td>
                                    <form action="{{ URL::to('/admin/' . $item->slug) }}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">                                                                       
                                        <input type="submit" class="btn btn-warning" value="Delete">
                                    </form>                                                    
                                    <a class="btn btn-small btn-success" href="{{ URL::to('/' . $item->slug) }}" target="blank">View</a>                                    
                                    <a class="btn btn-small btn-info" href="{{ URL::to('/admin/content/' . $item->slug) . '/edit' }}">Edit</a></td>
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>                                
                                <td>{{$item->category->slug}}</td>
                                <td>{{$item->is_published}}</td>
                                <td>{{$item->published_at}}</td>
                            </tr>
                            @endforeach                        
                        </table>

                        {!! $contentItems->render() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('footer_scripts')
    
@endsection

