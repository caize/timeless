<?php

namespace App\Http\Requests\Admin\Blog;

use App\Http\Requests\Admin\AdminRequest;

class PostCreateRequest extends AdminRequest
{

    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'slug' => 'required|max:100|alpha_dash|unique:blog_posts,slug',
            'summary' => 'required|max:500',
            'source' => 'sometimes|max:20',
            'source_url' => 'sometimes|max:100',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '标题必须',
            'title.max' => '标题最多100个字符',
            'summary.required' => '摘要必须',
            'summary.max' => '摘要最多500个字符',
            'slug.required' => 'SEO标题必须',
            'slug.max' => 'SEO标题最多100个字符',
            'slug.alpha_dash' => 'SEO标题仅允许字母、数字、破折号（-）以及底线（_）',
            'slug.unique' => 'SEO标题已存在',
            'source.max' => '来源最多20个字符',
            'source_url.max' => '来源链接最多100个字符',           
            'content.required' => '内容不能为空'
        ];
    }
}
