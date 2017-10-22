<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        return view('post.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load('comments');
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(Post $post)
    {
        //验证
        $this->validate(request(), [
            'title' => 'required|min:10|max:100',
            'content' => 'required|min:10'
        ]);

        $this->authorize('update', $post);

        $post->title = request('title');
        $post->content = request('content');
        $post->save();

        return redirect("/posts/{$post->id}");
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        //验证
        $this->validate(request(), [
            'title' => 'required|min:10|max:100',
            'content' => 'required|min:10'
        ]);
        //逻辑
        $user_id = Auth::id();
        $params = array_merge(request(['title', 'content']), compact('user_id'));
        $post = Post::create($params);
        //渲染视图
        return redirect('/posts');
    }

    public function destroy(Post $post)
    {
         $this->authorize('delete', $post);
         $post->delete();
         return redirect("/posts");
    }

    public function comment(Post $post)
    {
        //验证
        $this->validate(\request(), [
            'content' => 'required|min:3'
        ]);

        //逻辑
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->content = \request('content');
        $post->comments()->save($comment);
        //渲染
        return back();


    }
}
