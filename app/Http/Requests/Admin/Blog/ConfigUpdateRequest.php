<?php

namespace App\Http\Requests\Admin\Blog;

use App\Http\Requests\Admin\AdminRequest;

class ConfigUpdateRequest extends AdminRequest
{
    
    public function rules()
    {
        return [
            'name' => 'required|max:30|unique:blog_configs,name,' . $this->cid . ',cid',
            'value' => 'required|max:200',
            'desc' => 'sometimes|max:100'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '配置名称必须',
            'name.max' => '配置名称最多30个字符',
            'name.unique' => '配置名称已存在',
            'value.required' => '配置值必须',
            'value.max' => '配置值最多200个字符',
            'desc.max' => '描述最多100个字符'
        ];
    }
}
