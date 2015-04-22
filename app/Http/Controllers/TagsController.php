<?php namespace App\Http\Controllers;
use App\Tag;
use App\ContentItem;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\TagRequest;
use Illuminate\Support\Facades\Session;

class TagsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
        return \Redirect::to('/api/content/create')->with('message', 'Tag created');
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
        })->paginate(5);
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
