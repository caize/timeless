<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Repositories\BlogPostsRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Blog\PostCreateRequest;
use App\Http\Requests\Admin\Blog\PostUpdateRequest;
use Toastr, Breadcrumbs;

class PostController extends BaseController
{
    protected $post;

    public function __construct(BlogPostsRepositoryEloquent $post)
    {
    	parent::__construct();
    	$this->post = $post;

        Breadcrumbs::setView('admin._partials.breadcrumbs');

        Breadcrumbs::register('admin-blog-post', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('文章管理', route('admin.blog.post.index'));
        });

    }

    public function index()
    {
        Breadcrumbs::register('admin-blog-post-index', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-blog-post');
            $breadcrumbs->push('文章列表', route('admin.blog.post.index'));
        });

        $posts = $this->post->orderBy('updated_at', 'created_at')->paginate(10);
        return view('admin.blog.post.index', compact('posts'));
    }

    public function create()
    {
        Breadcrumbs::register('admin-blog-post-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-blog-post');
            $breadcrumbs->push('添加文章', route('admin.blog.post.create'));
        });

        return view('admin.blog.post.create');    	
    }

    public function store(PostCreateRequest $request)
    {
        $result = $this->post->save($request->all());
 
        if(!$result['status']) {
            Toastr::error($result['msg']);
            return redirect('admin/blog/post/create');
        } else {
            Toastr::success('新文章添加成功!');
            return redirect('admin/blog/post');
        }
    }

    public function edit($id)
    {
        Breadcrumbs::register('admin-blog-post-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-blog-post');
            $breadcrumbs->push('编辑文章', route('admin.blog.post.edit', ['id' => $id]));
        });

        $post = $this->post->find($id);
        $metas = $post->metas()->select('blog_metas.mid', 'blog_metas.type', 'blog_metas.name')->get();

        $hasClasses = [];
        $hasTags = [];

        foreach ($metas as $meta)
        {
            $meta->type == 'class' ?
            $hasClasses[] = $meta->mid : 
            $hasTags[] = $meta->name;
        }

        return view('admin.blog.post.edit', compact('post', 'hasClasses', 'hasTags'));
    }

    public function update(PostUpdateRequest $request, $id)
    {
        $this->post->save($request->all(), $id);

        Toastr::success('文章更新成功');
        
        return redirect(route('admin.blog.post.edit', ['id' => $id]));
    }

    public function destroy($id)
    {
        $result = $this->post->delete($id);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    public function destroyAll(Request $request)
    {
        if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }

        foreach ($ids as $id) {
            $result = $this->post->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }    
}
