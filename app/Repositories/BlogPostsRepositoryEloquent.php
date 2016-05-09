<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BlogPostsRepository;
use App\Models\BlogPosts;
use App\Models\BlogMetas;
use App\Validators\BlogPostsValidator;

/**
 * Class BlogPostsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class BlogPostsRepositoryEloquent extends BaseRepository implements BlogPostsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BlogPosts::class;
    }  

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function save(array $attributes, $id = 0)
    {
        $classes = array_get($attributes, 'classes');
        $tags = array_get($attributes, 'tags');

        if (!$classes)
        {
            return [
                'status' => false,
                'msg' => '请选择分类'
            ];
        }

        $attributes = array_except($attributes, ['classes', 'tags']);

        $result = $id ? parent::update($attributes, $id) : parent::create($attributes);

        if (!$result) return false;

        $tags = BlogMetas::getTagIds($tags);

        $this->syncMetas($result->pid, array_merge($classes, $tags));

        return [
            'status' => true
        ];
    }

    public function syncMetas($pid, $metas)
    {
        $post = $this->model->find($pid);
        $post->metas()->sync($metas);
    }

    public function view($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function postList($meta = null, $type = 'class')
    {
        $q = BlogPosts::with('metas');
        $meta && $q->whereHas('metas', function($query) use ($meta, $type) {
            $query->where('slug', $meta)->where('type', $type)->select('blog_metas.mid');
        }); 

        return $q->where('type', 'post')->orderBy('created_at', 'DESC')->paginate(10);
    }
}
