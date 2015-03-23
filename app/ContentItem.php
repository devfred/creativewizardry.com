<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentItem extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'content_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content'];

}
