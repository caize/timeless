<?php

namespace App\Presenters;

use App\Repositories\BlogMetasRepositoryEloquent;
use App\Transformers\BlogMetasTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BlogMetasPresenter
 *
 * @package namespace App\Presenters;
 */
class BlogMetasPresenter extends FractalPresenter
{
    protected $meta;

    public function __construct(BlogMetasRepositoryEloquent $meta)
    {
        $this->meta = $meta;
    }

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BlogMetasTransformer();
    }

    public function classesSelect($hasClasses = [])
    {
		$classes = $this->meta->findWhere(['type' => 'class'], ['mid', 'name']);

		$select = '';
		if (!$classes->count()) return $select;

		foreach ($classes as $class)
		{
			$selected = in_array($class->mid, $hasClasses) ? 'selected="selected"' : '';
			$select .= '<option value="'. $class->mid .'" ' . $selected . '>' . $class->name . '</option>';
		}

		return $select;
    }

    public function tagsLink($post)
    {
        $metas = $post->metas()
                    ->select('blog_metas.slug', 'blog_metas.name', 'blog_metas.type')
                    ->get();

        $link = '';    
        if ($metas)
        {
            foreach ($metas as $meta)
            {
                $type = $meta->type == 'tag' ? 'tags/' : ''; 
                $link .= '<a href="' . url($type . $meta->slug) . '">' . $meta->name . '</a> | ';
            }
        }
        $link = trim(trim($link), '|');
        return $link;
    }
}
