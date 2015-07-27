<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\ContentItem;
use App\Tag;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ContentItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$view = ($this->isAdminRequest()) ? 'admin.content' : 'content.content';		
        
        if( $this->isAdminRequest() ){
        	$contentItems = ContentItem::orderBy('published_at', 'DESC')->paginate(5);
        }else{
        	$contentItems = ContentItem::where('is_published', true)->orderBy('published_at', 'DESC')->paginate(5);
        }
		return view( $view, compact('contentItems') );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        if (!Auth::check())
        {
            return Redirect::to('/auth/login')->with('message', 'Action requires login');
        }
        return view('content.create');

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ContentItemRequest $request)
	{
        $title = $request->get('title');
        $slug = str_slug( $title );
        $item = ContentItem::create([
        	'title' => $title, 
        	'slug'=>$slug,
        	'excerpt'=> $request->get('excerpt'), 
        	'content'=> $request->get('content'), 
        	'user_id'=>1, 
        	'category_id'=>$request->get('category_id'),
        	'published_at'=>$request->get('published_at'),
        	'is_published'=>\Input::get('is_published') ? 1 :0 
        ]);
        $tags = explode(',',$request->get('tag_list'));        
		$item->tags()->sync($tags);	       
        return \Redirect::to('/admin/content')->with('message', 'Content Item created');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $slug
	 * @return Response
	 */
	public function show($slug)
	{
        $item = ContentItem::findBySlug($slug);
		return view('content.show', compact('item') );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($slug)
	{
		//
		if (!Auth::check())
        {
            return Redirect::to('/auth/login')->with('message', 'Action requires login');
        }
        $item = ContentItem::findBySlug($slug);       
		return view('content.edit', compact('item') );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($slug)
	{
		if (!Auth::check())
        {
            return Redirect::to('/auth/login')->with('message', 'Action requires login');
        }
        $item = ContentItem::findBySlug($slug);
        $item->title = \Input::get('title');	
        $item->slug = str_slug( \Input::get('title') );
        $item->excerpt = \Input::get('excerpt'); 
        $item->content = \Input::get('content');
        $item->category_id = \Input::get('category_id');
        $item->published_at = \Input::get('published_at');
		$item->is_published = \Input::get('is_published') ? 1 :0;
		$item->save();
		$tags = explode(',',\Input::get('tag_list'));
		$item->tags()->sync($tags);		        
        return \Redirect::to('/admin/content')->with('message', 'Item Updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($slug)
	{
		if (!Auth::check())
        {
            return Redirect::to('/auth/login')->with('message', 'Action requires login');
        }
        $item = ContentItem::findBySlug($slug);
        $item->delete();
        return \Redirect::to('/admin/content')->with('message', 'Item Deleted');
	}

}
