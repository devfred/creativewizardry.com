<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

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
    protected $fillable = ['title', 'content', 'excerpt', 'slug', 'user_id', 'category_id', 'created_at'];

    /**
     * Return User associated with ContentItem
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
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
        $this->attributes['slug'] = str_slug($data);
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
