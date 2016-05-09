<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BlogConfigsRepository;
use App\Models\BlogConfigs;
use App\Validators\BlogConfigsValidator;

/**
 * Class BlogConfigsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class BlogConfigsRepositoryEloquent extends BaseRepository implements BlogConfigsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BlogConfigs::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
