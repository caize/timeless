<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class BlogMetas extends Model implements Transformable
{
    use TransformableTrait;

    public $timestamps = false;

    protected $guarded = ['mid'];

    protected $primaryKey = 'mid';

    public function posts()
    {
    	return $this->belongsToMany('App\Models\BlogPosts', 'blog_mappings');
    }

    public static function getTagIds($tags)
    {
        if (!$tags) return [];

        $tags = explode(',', $tags);
        $tagIds = [];
        foreach ($tags as $tag)
        {
            $mid = self::where('name', $tag)->where('type', 'tag')->value('mid');
            if (!$mid)
            {
                $mid = self::insertGetId([
                        'name' => $tag,
                        'type' => 'tag',
                        'slug' => $tag
                    ]);
            }
            $tagIds[] = $mid;
        }
        return $tagIds;
    }

}
