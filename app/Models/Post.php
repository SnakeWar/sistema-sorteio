<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
//    public function setTitleAttribute($value)
//    {
//        $slug = Str::slug($value);
//        //$matchs = $this->uniqueSlug($slug);
//        $this->attributes['title'] = $value;
//        $this->attributes['slug'] = $slug;
//        //$this->attributes['slug'] = $matchs ? $slug . '-' . $matchs : $slug;
//    }
//    public function uniqueSlug($slug)
//    {
//        $matchs = $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->count();
//        return $matchs;
//    }

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function gallery(){
        return $this->belongsTo(Gallery::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function comments()
    {
        return$this->hasMany(Comment::class);
    }
}
