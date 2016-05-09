<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class BlogPosts extends Model implements Transformable
{
    use TransformableTrait;

    protected $guarded = ['pid'];

    protected $primaryKey = 'pid';

    public function metas()
    {
    	return $this->belongsToMany('App\Models\BlogMetas', 'blog_mappings', 'pid', 'mid');
    }

}
