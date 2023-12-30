<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('user_id', auth()->user()->id)->orderBy('updated_at', 'desc')->paginate(10);
        $count = Post::where('user_id', auth()->user()->id)->count();
        
        return view('posts.index', [
            'posts' => $posts,
            'count' => $count,
            'arrayOfLast30Days' => $this->getArrayOfLast30Days(),
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        if (!$search) {
            return redirect()->route('posts.index');
        }
        $posts = Post::where('body', 'like', '%'.$search.'%')->paginate(10);
        $count = Post::where('body', 'like', '%'.$search.'%')->count();

        return view('posts.index', [
            'posts' => $posts,
            'count' => $count,
            'arrayOfLast30Days' => $this->getArrayOfLast30Days(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validate([
            'body' => 'required'
        ]);

        $post = new Post();
        $post->user_id = auth()->user()->id;
        $post->body = $data['body'];
        $post->save();

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validate([
            'body' => 'required'
        ]);

        $post->body = $data['body'];
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return back();
    }

    private function getArrayOfLast30Days()
    {
        $today = date('Y-m-d');
        $arrayOfLast30Days = array();
        for ($i = 0; $i < 30; $i++) {
            $arrayOfLast30Days[$i]['date'] = date('Y-m-d', strtotime($today . ' - ' . $i . ' days'));
            $arrayOfLast30Days[$i]['countPosts'] = count(Post::where('user_id', auth()->user()->id)->whereDate('updated_at', $arrayOfLast30Days[$i]['date'])->get());
        }
        return $arrayOfLast30Days;
    }
}
