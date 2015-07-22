<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\ContentItem;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller {

    public function search($search)
    {
        $contentItems = ContentItem
            ::like('content', "$search")
            ->like('excerpt', "$search")
            ->like('title', "$search")
            ->paginate(5);

        if($contentItems->count() > 0)
        {
            Session::flash('message', "Search: $search");
        }else{
            Session::flash('message', "No results for $search");
        }

        foreach($contentItems as $item){
            $item["title"] = $this->highlight($item["title"],$search);
            $item["excerpt"] = $this->highlight($item["excerpt"],$search);
            $item["content"] = $this->highlight($item["content"],$search);
        }

        return view('content.content', compact('contentItems') );
    }

    function highlight($text, $words) {
        preg_match_all('~\w+~', $words, $m);
        if(!$m)
            return $text;
        $re = '~\\b(' . implode('|', $m[0]) . ')\\b~i';
        return preg_replace($re, '<span class="highlight">$0</span>', $text);
    }

}
