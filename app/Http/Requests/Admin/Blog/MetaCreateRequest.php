<?php

namespace App\Http\Requests\Admin\Blog;

use App\Http\Requests\Admin\AdminRequest;

class MetaCreateRequest extends AdminRequest
{

    public function rules()
    {
        return [
            'name' => 'required|max:20|unique:blog_metas,name,null,mid,type,class',
            'slug' => 'required|max:100|alpha_dash|unique:blog_metas,slug,null,mid,type,class',
            'desc' => 'sometimes|max:100',
            'order' => 'sometimes|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '分类名称必须',
            'name.max' => '分类名称最多20个字符',
            'name.unique' => '分类名称已存在',
            'slug.required' => 'SEO名称必须',
            'slug.max' => 'SEO名称最多20个字符',
            'slug.alpha_dash' => 'SEO标题仅允许字母、数字、破折号（-）以及底线（_）',
            'slug.unique' => 'SEO名称已存在',
            'desc.max' => '描述最多100个字符',          
            'order.integer' => '排序必须为整型'
        ];
    }
}