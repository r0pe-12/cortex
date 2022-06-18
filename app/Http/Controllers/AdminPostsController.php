<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource. index page na kojoj cemo prikazivati tabelu sa svim postovima
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
        $posts = Post::latest()->paginate('4');
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        //
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
    {
        $input = $request->all();
        $input['published_at'] = str_replace('T', ' ', $input['published_at']) . ':00';

        if ($file = $request->file('picture')){
            $name = now('Europe/Belgrade')->format('Y_m_d\_H_i_s') . '_' . $file->getClientOriginalName();
            $file->storeAs('/images/posts', $name);
            $input['picture'] = $name;
        }
        $post = new Post($input);

        \Auth::user()->posts()->save($post);
        session()->flash('created', 'Post "' . $post->title . '" was successfully created');
        return redirect()->route('admin.posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Post $post)
    {
        //
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        //
        $input = $request->all();
        if ($request->post('published_at')){
            $input['published_at'] = str_replace('T', ' ', $input['published_at']) . ':00';
        }

        if ($file = $request->file('picture')){
            $name = now('Europe/Belgrade')->format('Y_m_d\_H_i_s') . '_' . $file->getClientOriginalName();
            $file->storeAs('/images/posts', $name);
            $input['picture'] = $name;

            if (file_exists($picture = public_path() . $post->picture)){
                unlink($picture);
            }

        }
        $post->update($input);
        session()->flash('updated', 'Post "' . $post->title . '" was successfully updated');
        return redirect()->route('admin.posts.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        //
        if (file_exists($picture = public_path() . $post->picture)){
            unlink($picture);
        }
        $post->delete();
        session()->flash('deleted', 'Post was successfully deleted');
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the picture for specified resource resource from storage.
     *
     */
    public function destroyPicture($post_id){
        # code
        $post = Post::findOrFail($post_id);
        if (file_exists($picture = public_path() . $post->picture)){
            unlink($picture);
            session()->flash('deleted', 'Picture for post: "' . $post->title . '" was successfully deleted');
        }
            $post->update(['picture'=>null]);
        return redirect()->route('admin.posts.index');
    }
}
