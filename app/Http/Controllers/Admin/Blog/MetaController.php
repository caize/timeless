<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Repositories\BlogMetasRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Blog\MetaCreateRequest;
use App\Http\Requests\Admin\Blog\MetaUpdateRequest;
use Toastr, Breadcrumbs;

class MetaController extends BaseController
{
    protected $meta;

    public function __construct(BlogMetasRepositoryEloquent $meta)
    {
    	parent::__construct();
    	$this->meta = $meta;

        Breadcrumbs::setView('admin._partials.breadcrumbs');

        Breadcrumbs::register('admin-blog-meta', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('分类管理', route('admin.blog.meta.index'));
        });

    }

    public function index()
    {
        Breadcrumbs::register('admin-blog-meta-index', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-blog-meta');
            $breadcrumbs->push('分类列表', route('admin.blog.meta.index'));
        });

        $metas = $this->meta->orderBy('order')->paginate(10);
        return view('admin.blog.meta.index', compact('metas'));
    }

    public function create()
    {
        Breadcrumbs::register('admin-blog-meta-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-blog-meta');
            $breadcrumbs->push('添加分类', route('admin.blog.meta.create'));
        });

        return view('admin.blog.meta.create');    	
    }

    public function store(MetaCreateRequest $request)
    {
        $result = $this->meta->create($request->all());
 
        if(!$result) {
            Toastr::error('新分类添加失败!');
            return redirect('admin/blog/meta/create');
        } else {
            Toastr::success('新分类添加成功!');
            return redirect('admin/blog/meta');
        }
    }

    public function edit($id)
    {
        Breadcrumbs::register('admin-blog-meta-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-blog-meta');
            $breadcrumbs->push('编辑分类', route('admin.blog.meta.edit', ['id' => $id]));
        });

        $meta = $this->meta->find($id);
        return view('admin.blog.meta.edit', compact('meta'));
    }

    public function update(MetaUpdateRequest $request, $id)
    {
        $this->meta->update($request->all(), $id);

        Toastr::success('分类更新成功');
        
        return redirect(route('admin.blog.meta.edit', ['id' => $id]));
    }

    public function destroy($id)
    {
        $result = $this->meta->delete($id);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    public function destroyAll(Request $request)
    {
        if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }

        foreach ($ids as $id) {
            $result = $this->meta->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }    
}
