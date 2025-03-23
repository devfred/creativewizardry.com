@extends('app')
@section('content')
<div class="bg-white py-24 sm:py-32">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto max-w-2xl lg:mx-0">
      <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl"><a href="/">Creative Wizardry</a></h2>
      <p class="mt-2 text-lg/8 text-gray-600">Notes / Thoughts / Research</p>
    </div>
    <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
    
    @foreach($contentItems as $item)    
    @if ( strtotime($item->published_at) <= strtotime('now') )

      <article class="flex max-w-xl flex-col items-start justify-between">
        <div class="flex items-center gap-x-4 text-xs">
          <time datetime="2020-03-16" class="text-gray-500">{{ date("F d, Y",strtotime($item->published_at)) }}</time>
          <a href="{{ url("/categories/" . $item->category->slug) }}" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">{{$item->category->name}}</a>
        </div>
        <div class="group relative">
          <h3 class="mt-3 text-lg/6 font-semibold text-gray-900 group-hover:text-gray-600">
            <a href="#">
              <span class="absolute inset-0"></span>
              <a href="{{ url( '/'. $item->slug ) }}">{!!$item->title!!}</a>
            </a>
          </h3>          
          <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600">         
          {!! $item->excerpt !!}
          </p>
        </div>
        <div class="relative mt-8 flex items-center gap-x-4">          
          <div class="text-sm/6">            
            @foreach($item->tags as $tag)
                <span class="tag text-gray-600"><a class="label label-default" href="{{ url("/tags/" . $tag->slug) }}">{{$tag->name}}</a> </span>
            @endforeach
          </div>          
        </div>
      </article>
    
    @endif
    @endforeach
             
    </div>
  </div>
</div>    
@endsection