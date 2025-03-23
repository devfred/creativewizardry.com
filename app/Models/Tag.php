<?php namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model {

    protected $fillable = ['name', 'slug'];
    public function content_items()
    {
        return $this->belongsToMany('App\Models\ContentItem');
    }
    public function setSlugAttribute($data)
    {
        if (Str::slug($data) != '') {
            $this->attributes['slug'] = Str::slug($data);
        } else {
            $this->attributes['slug'] = $data;
        }
    }
    public function scopeFindBySlug($query, $slug)
    {
        return $query->whereSlug($slug)->firstOrFail();
    }

}
