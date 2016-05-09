<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\BlogPostsRepositoryEloquent;

class BlogController extends Controller
{
    protected $post;

    public function __construct(BlogPostsRepositoryEloquent $post)
    {
    	$this->post = $post;
    }

    public function index($class = null)
    {
        $posts = $this->post->postList($class);
        return view('blog.index', compact('posts'));
    }

    public function postListByTag($tag)
    {
        $posts = $this->post->postList($tag, 'tag');
        return view('blog.index', compact('posts'));        
    }

    public function view($slug)
    {
        if (!$post = $this->post->view($slug))
            abort(404);
        
        return view('blog.view', compact('post'));
    }
}
