@extends('admin')
@section('content')
    <h2 class="page-title">Edit Content</h2>

    <h3>Edit Content Item</h3>
	<form class="form-horizontal" role="form" method="POST" action="{{url('/admin/content/' . $item->slug ) }}">
        <input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="form-group">
			<label class="col-md-4 control-label">Title</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="title" value="{{ $item->title }}">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label">Category</label>
			<div class="col-md-6">
                <select class="form-control" name="category_id">
                @foreach(DB::table('categories')->get() as $category)
                    @if( $item->category_id == $category->id )
                    <option value="{{$category->id}}" selected="selected">{{$category->name}}</option>
                    @else
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endif                   
                @endforeach
                </select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label">Tags</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="tag_list" value="{{ implode(",", $item->tag_list) }}">
                @foreach(DB::table('tags')->get() as $tag)
                    <span class="tag form-tag" data-id="{{$tag->id}}"><a class="label label-default">{{$tag->name}}</a> </span>
                @endforeach
			</div>
		</div>
        <div class="form-group">
            <label class="col-md-4 control-label">Excerpt</label>
            <div class="col-md-6">
                <textarea class="form-control" name="excerpt">{{ $item->excerpt }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Publish Date</label>
            <div class="col-md-6">
                <input class="form-control" name="published_at" value="{{ $item->published_at }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Is Published</label>
            <div class="col-md-6">            
                @if( $item->is_published )
                <input type="checkbox" name="is_published" checked="checked">
                @else
                <input type="checkbox" name="is_published">
                @endif                   
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Content</label>
            <div class="col-md-6">
                <textarea class="form-control" name="content">{{ $item->content }}</textarea>
            </div>
        </div>
		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				<button type="submit" class="btn btn-primary">Update</button>
			</div>							
		</div>
	</form>
@endsection
@section('footer_scripts')
    <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea[name='excerpt']",
            plugins: "code"
        });
        tinymce.init({
            selector: "textarea[name='content']",
            plugins: "code"
        });
    </script>
    <script>
        var FormTagHelper = (function($){
            var $tags = $('span.form-tag');
            var $tagInput = $('input[name="tag_list"]');
            var AddTagToList = function(){
                var $this = $(this);
                var id = $this.attr('data-id');
                var val = $.trim($tagInput.val());
                var values = [];
                var exists = false;
                if(val){
                    values = val.split(',');
                    if(values.length){
                        $.each(values, function(){
                            if(parseInt(this) === parseInt(id)){
                                exists = true;
                            }
                        });
                    }
                }
                if(!exists){
                    values.push(id);
                }
                $tagInput.val(values.join(','));
                return false;
            };
            $tags.bind('click', AddTagToList);
        })(jQuery);
    </script>
@endsection
