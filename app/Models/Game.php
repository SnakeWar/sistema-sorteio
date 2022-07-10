<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Game extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
