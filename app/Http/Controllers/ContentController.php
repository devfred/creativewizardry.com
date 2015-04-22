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
        $contentItems = ContentItem::paginate(5);
		return view('content.content', compact('contentItems') );
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
            return Redirect::to("/");

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
        $item = ContentItem::create(['title' => $title, 'slug'=>$slug,'excerpt'=> $request->get('excerpt'), 'content'=> $request->get('content'), 'user_id'=>1, 'category_id'=>$request->get('category_id') ]);
        $tags = explode(',',$request->get('tag_list'));
        $content_tags = array();
        //Get content tags from form
        foreach($tags as $tag){
            array_push($content_tags, array('content_item_id' => $item->id, 'tag_id'=>$tag));
        }

        DB::table('content_item_tag')->insert($content_tags);
        return \Redirect::to('/api/content/create')->with('message', 'Content Item created');
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
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
