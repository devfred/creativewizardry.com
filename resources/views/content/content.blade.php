@extends('app')
@section('content')
    <div class="articles">
    @foreach($contentItems as $item)    
    @if ( strtotime($item->published_at) <= strtotime('now') )
            
        <div class="article mb-2">
            <p class="category"><a href="{{ url("/categories/" . $item->category->slug) }}">{{$item->category->name}}</a></p>
            <h2><a href="{{ url( '/'. $item->slug ) }}">{!!$item->title!!}</a></h2>
            <p class="meta">
                <i class="fa fa-tags"></i>
                @foreach($item->tags as $tag)
                    <span class="tag "><a class="label label-default" href="{{ url("/tags/" . $tag->slug) }}">{{$tag->name}}</a> </span>
                @endforeach
                <span class="time"><i class="fa fa-calendar"></i> <time>{{ date("F d, Y",strtotime($item->published_at)) }}</time></span>
            </p>
            <p>{!! $item->excerpt !!}</p>
            <a href="{{ url( '/'. $item->slug ) }}">Read More</a>
        </div>        
    
    @endif
    @endforeach
    </div><!-- end .articles -->
    
@endsection