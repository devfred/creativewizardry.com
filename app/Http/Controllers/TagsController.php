<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Tag;
use App\ContentItem;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\TagRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class TagsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$view = ($this->isAdminRequest()) ? 'admin.tags' : 'tags.content';		
        $contentItems = Tag::paginate(5);
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
            return \Redirect::to('/auth/login')->with('message', 'Action requires login');
        }
        return view('tags.create');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param TagRequest $request
     * @return Response
     */
	public function store(TagRequest $request)
	{
		Tag::create(['name' => $request->get('name'), 'slug'=>$request->get('slug')]);
        return \Redirect::to('/admin/tags')->with('message', 'Tag created');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
        $tag = Tag::findBySlug($slug);
        $contentItems = ContentItem::with('tags', 'category')->whereHas('tags', function ($query) use ($slug) {
            $query->whereSlug($slug);
        })->where('is_published', true)->orderBy('published_at', 'DESC')->paginate(5);
        //Session::flash('message', "Tag: $tag->name");
        return view('content.content', compact('contentItems', 'tag') );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if (!Auth::check())
        {
            return \Redirect::to('/auth/login')->with('message', 'Action requires login');
        }
        $item = Tag::find($id);     
		return view('tags.edit', compact('item') );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if (!Auth::check())
        {
            return Redirect::to('/auth/login')->with('message', 'Action requires login');
        }
        $item = Tag::find($id);
        $item->name = \Input::get('name');	
        $item->slug = str_slug( \Input::get('name') );        
		$item->save();		
        return \Redirect::to('/admin/tags')->with('message', 'Item Updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if (!Auth::check())
        {
            return \Redirect::to('/auth/login')->with('message', 'Action requires login');
        }
        $item = Tag::find($id);
        $item->delete();
        DB::table('content_item_tag')->where('tag_id', '=', $id)->delete();       
        return \Redirect::to('/admin/tags')->with('message', 'Item Deleted');
	}

}
