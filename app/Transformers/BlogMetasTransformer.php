<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\BlogMetas;

/**
 * Class BlogMetasTransformer
 * @package namespace App\Transformers;
 */
class BlogMetasTransformer extends TransformerAbstract
{

    /**
     * Transform the \BlogMetas entity
     * @param \BlogMetas $model
     *
     * @return array
     */
    public function transform(BlogMetas $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
