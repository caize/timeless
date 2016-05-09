<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BlogMetasRepository;
use App\Models\BlogMetas;
use App\Validators\BlogMetasValidator;

/**
 * Class BlogMetasRepositoryEloquent
 * @package namespace App\Repositories;
 */
class BlogMetasRepositoryEloquent extends BaseRepository implements BlogMetasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BlogMetas::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function attachMetas()
    {
        
    }
}
