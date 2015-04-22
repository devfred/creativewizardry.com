@extends('app')

@section('title'){{$item->title}}@endsection
@section('description'){{$item->excerpt}}@endsection

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
                        <span class="time"><i class="fa fa-calendar"></i> <time>{{ date("F d, Y",strtotime($item->created_at)) }}</time></span>
                </p>
		        <p>{!! $item->content !!}</p>
                <div class="module share">
                    <a class="btn btn-default tw" target="_blank" href="https://twitter.com/intent/tweet?text={{$item->title}}&url={{ URL::current() }}&via=cwizardry"><i class="fa fa-twitter fa-lg"></i> Share on Twitter</a>
                    <a class="btn btn-default fb" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ URL::current() }}"><i class="fa fa-facebook fa-lg"></i> Share on Facebook</a>
                    <a class="btn btn-default gp" target="_blank" href="https://plus.google.com/share?url={{ URL::current() }}"><i class="fa fa-google-plus fa-lg"></i> Share on Google+</a>
                </div>
                <div class="module comments">
                    <div id="disqus_thread"></div>
                    <script type="text/javascript">
                        /* * * CONFIGURATION VARIABLES * * */
                        var disqus_shortname = 'creativewizardry';
                        var disqus_identifier = '{{$item->slug}}';
                        var disqus_title = '{{$item->title}}';
                        var disqus_url = '{{URL::current()}}';
                        /* * * DON'T EDIT BELOW THIS LINE * * */
                        (function() {
                            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
                </div>
	        </div>
	    </article>
    </div><!-- end .article -->   
@endsection
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('/js/prism/prism.js') }}"></script>
@endsection

