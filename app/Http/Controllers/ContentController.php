<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ContentItem;

use Illuminate\View\View;

class ContentController extends Controller
{
    public function index(): view
	{	
        $contentItems = ContentItem::where('is_published', true)->orderBy('published_at', 'DESC')->paginate(5);
		return view('content.content', compact('contentItems'));
	}

	public function detail(string $slug): view
	{	
        $contentItems = ContentItem::where('is_published', true)->orderBy('published_at', 'DESC')->paginate(5);
		return view('content.content', compact('contentItems'));
	}

	public function get_content_by_tag(string $tag): view
	{	
        $contentItems = ContentItem::where('is_published', true)->orderBy('published_at', 'DESC')->paginate(5);
		return view('content.content', compact('contentItems'));
	}

	public function get_content_by_category(string $category): view
	{	
        $contentItems = ContentItem::where('is_published', true)->orderBy('published_at', 'DESC')->paginate(5);
		return view('content.content', compact('contentItems'));
	}


}
