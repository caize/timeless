<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class BlogConfigs extends Model implements Transformable
{
    use TransformableTrait;

    public $timestamps = false;

    protected $guarded = ['cid'];

    protected $primaryKey = 'cid';

}
