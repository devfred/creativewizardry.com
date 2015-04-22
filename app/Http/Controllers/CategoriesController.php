<?php namespace App\Http\Controllers;

use App\Category;
use App\ContentItem;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller {

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
     * @param CategoryRequest $request
     * @return Response
     */
	public function store(CategoryRequest $request)
	{
        Category::create(['name' => $request->get('name'), 'slug'=>$request->get('slug')]);
        return \Redirect::to('/api/content/create')->with('message', 'Category created');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $slug
	 * @return Response
	 */
    public function show($slug)
    {
        $category = Category::findBySlug($slug);
        $contentItems = ContentItem::with('tags', 'category')->whereHas('category', function ($query) use ($slug) {
            $query->whereSlug($slug);
        })->paginate(5);
        //Session::flash('message', "Category: $category->name");
        return view('content.content', compact('contentItems', 'category'));
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
