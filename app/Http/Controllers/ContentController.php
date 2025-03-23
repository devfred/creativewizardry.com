<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ContentItem;
use App\Models\Tag;
use App\Models\Category;

use Illuminate\View\View;

class ContentController extends Controller
{
    public function index(): view
	{	
        $contentItems = ContentItem::where('is_published', true)->orderBy('published_at', 'DESC')->paginate(5);
		return view('content.content', compact('contentItems'));
	}

	public function get_content_by_slug(string $slug): view
	{	
        $contentItems = ContentItem::where('is_published', true)->orderBy('published_at', 'DESC')->paginate(5);
		return view('content.content', compact('contentItems'));
	}

	public function get_content_by_tag(string $tagSlug): view
	{	
		$tag = Tag::findBySlug($tagSlug);
        $contentItems = ContentItem::with('tags', 'category')->whereHas('tags', function ($query) use ($tagSlug) {
            $query->whereSlug($tagSlug);
        })->where('is_published', true)->orderBy('published_at', 'DESC')->paginate(5);        
        return view('content.content', compact('contentItems', 'tag') );       
	}

	public function get_content_by_category(string $categorySlug): view
	{	
        $category = Category::findBySlug($categorySlug);
        $contentItems = ContentItem::with('tags', 'category')->whereHas('category', function ($query) use ($categorySlug) {
            $query->whereSlug($categorySlug);
        })->where('is_published', true)->orderBy('published_at', 'DESC')->paginate(5);
        return view('content.content', compact('contentItems', 'category'));
	}

	public function get_static_content(string $viewName): view
	{
		return view("content.$viewName");
	}

}
