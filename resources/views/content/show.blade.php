@extends('app')

@section('title'){{$item->title}}@endsection
@section('description'){{$item->excerpt}}@endsection
@section('header_scripts')
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "BlogPosting",
  "headline": "{{$item->title}}",
  "alternativeHeadline": "{{$item->title}}",
  "image": "",
  "datePublished": "{{$item->published_at}}",
  "articleBody": "{!! $item->content !!}"
}
</script>
@endsection
@section('content')
    

    <div class="article">
	    <article>
	    	<div class="article">
                <p class="category"><a href="{{ url("/categories/" . $item->category->slug) }}">{{$item->category->name}}</a></p>
	    		<h1>{{$item->title}}</h1>
                <p class="meta">
                    <i class="fa fa-tags"></i>
                @foreach($item->tags as $tag)
                        <span class="tag "><a class="label label-default" href="{{ url("/tags/" . $tag->slug) }}">{{$tag->name}}</a> </span>
                    @endforeach
                        <span class="time"><i class="fa fa-calendar"></i> <time>{{ date("F d, Y",strtotime($item->published_at)) }}</time></span>
                </p>
		        <p>{!! $item->content !!}</p>
                <div class="module share">
                    <a class="btn btn-default tw" target="_blank" href="https://twitter.com/intent/tweet?text={{$item->title}}&url={{ URL::current() }}&via=cwizardry"><i class="fa fa-twitter fa-lg"></i> Share on Twitter</a>
                    <a class="btn btn-default fb" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ URL::current() }}"><i class="fa fa-facebook fa-lg"></i> Share on Facebook</a>
                    <a class="btn btn-default gp" target="_blank" href="https://plus.google.com/share?url={{ URL::current() }}"><i class="fa fa-google-plus fa-lg"></i> Share on Google+</a>
                </div>                
	        </div>
	    </article>
    </div><!-- end .article -->   
@endsection
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('/js/prism/prism.js') }}"></script>
@endsection

