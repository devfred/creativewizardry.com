<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    protected $fillable = ['name', 'slug'];
    public function content_items()
    {
        return $this->belongsToMany('App\ContentItem');
    }
    public function setSlugAttribute($data)
    {
        if (str_slug($data) != '') {
            $this->attributes['slug'] = str_slug($data);
        } else {
            $this->attributes['slug'] = $data;
        }
    }
    public function scopeFindBySlug($query, $slug)
    {
        return $query->whereSlug($slug)->firstOrFail();
    }

}
