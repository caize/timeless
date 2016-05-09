<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Repositories\BlogConfigsRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Blog\ConfigCreateRequest;
use App\Http\Requests\Admin\Blog\ConfigUpdateRequest;
use Toastr, Breadcrumbs;

class ConfigController extends BaseController
{
    protected $config;

    public function __construct(BlogConfigsRepositoryEloquent $config)
    {
    	parent::__construct();
    	$this->config = $config;

        Breadcrumbs::setView('admin._partials.breadcrumbs');

        Breadcrumbs::register('admin-blog-config', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('配置管理', route('admin.blog.config.index'));
        });

    }

    public function index()
    {
        Breadcrumbs::register('admin-blog-config-index', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-blog-config');
            $breadcrumbs->push('配置列表', route('admin.blog.config.index'));
        });

        $configs = $this->config->paginate(10);
        return view('admin.blog.config.index', compact('configs'));
    }

    public function create()
    {
        Breadcrumbs::register('admin-blog-config-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-blog-config');
            $breadcrumbs->push('添加配置', route('admin.blog.config.create'));
        });

        return view('admin.blog.config.create');    	
    }

    public function store(configCreateRequest $request)
    {
        $result = $this->config->create($request->all());
 
        if(!$result) {
            Toastr::error('新配置添加失败!');
            return redirect('admin/blog/config/create');
        } else {
            Toastr::success('新配置添加成功!');
            return redirect('admin/blog/config');
        }
    }

    public function edit($id)
    {
        Breadcrumbs::register('admin-blog-config-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-blog-config');
            $breadcrumbs->push('编辑配置', route('admin.blog.config.edit', ['id' => $id]));
        });

        $config = $this->config->find($id);
        return view('admin.blog.config.edit', compact('config'));
    }

    public function update(configUpdateRequest $request, $id)
    {
        $this->config->update($request->all(), $id);

        Toastr::success('配置更新成功');
        
        return redirect(route('admin.blog.config.edit', ['id' => $id]));
    }

    public function destroy($id)
    {
        $result = $this->config->delete($id);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    public function destroyAll(Request $request)
    {
        if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }

        foreach ($ids as $id) {
            $result = $this->config->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }    
}
