<?php

namespace App\Http\Requests\Admin\Role;

use App\Http\Requests\Admin\AdminRequest;

class UpdateRequest extends AdminRequest
{

    public function rules()
    {
        return [
            'display_name' => 'sometimes|max:100',
            'description' => 'sometimes|max:100',
        ];
    }

    public function messages()
    {
        return [
            'display_name.max' => '角色显示名称最多100个字符',
            'description.max' => '角色说明最多100字符'
        ];
    }
}
