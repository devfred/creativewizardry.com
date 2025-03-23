<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Str;

class ContentItem extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'content_items';


    protected $appends = ['tag_list'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content', 'excerpt', 'slug', 'user_id', 'category_id', 'created_at','published_at','is_published'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'published_at'];

    /**
     * Return User associated with ContentItem
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function getTagListAttribute()
    {
        return $this->tags->lists('id');
    }

    public function setCreatedAtAttribute($date)
    {
        if (is_string($date)) {
            $this->attributes['created_at'] = Carbon::createFromFormat('Y-m-d', $date);
        } else {
            $this->attributes['created_at'] = $date;
        }
    }
    public function setSlugAttribute($data)
    {
        $this->attributes['slug'] = Str::slug($data);
    }
    public function scopeFindBySlug($query, $slug)
    {
        return $query->whereSlug($slug)->firstOrFail();
    }

    public function scopeLike($query, $field, $value)
    {
        return $query->orWhere($field,'Like',"%$value%");
    }

}
