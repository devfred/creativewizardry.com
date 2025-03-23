<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Category extends Model {

    protected $fillable = ['name', 'slug', 'parent_id'];
    public function content_items()
    {
        return $this->hasMany('App\Models\ContentItem');
    }
    public function setSlugAttribute($data)
    {
        $this->attributes['slug'] = Str::slug($data);
    }
    public function scopeGetTopLevel($query)
    {
        return $query->where('parent_id', 0)->get();
    }
    public function scopeFindBySlug($query, $slug)
    {
        return $query->whereSlug($slug)->firstOrFail();
    }
    public static function getLeveledCategories()
    {
        return \Cache::tags('categories')->rememberForever('leveled_categories', function () {
            $categories = Category::all();
            $result = array();
            foreach ($categories as $category) {
                if ($category->parent_id == 0) {
                    $result['top'][] = $category;
                    foreach ($categories as $scategory) {
                        if ($scategory->parent_id == $category->id) {
                            $result['second'][$category->id][] = $scategory;
                        }
                    }
                }
            }
            return $result;
        });
    }
    public static function getSortedCategories()
    {
        return \Cache::tags('categories')->rememberForever('sorted_categories', function () {
            $categories = Category::all();
            $result = array();
            foreach ($categories as $category) {
                if ($category->parent_id == 0) {
                    $result[] = $category;
                    foreach ($categories as $scategory) {
                        if ($scategory->parent_id == $category->id) {
                            $result[] = $scategory;
                        }
                    }
                }
            }
            return $result;
        });
    }

}
