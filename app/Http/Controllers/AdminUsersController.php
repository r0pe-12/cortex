<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
//    todo makni route model binding svuda

    public function __construct()
    {
        $this->middleware('admin')->except('update', 'edit');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the posts for specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showPosts(User $user)
    {
        //
        $posts = $user->posts()->paginate(4);
        return view('admin.users.posts', compact('posts', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        //
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        //
        $input = $request->all();
        if ($file = $request->file('picture')){
            $name = now('Europe/Belgrade')->format('Y_m_d\_H_i_s') . '_' . $file->getClientOriginalName();
            $file->storeAs('/images/users', $name);
            $input['picture'] = $name;

            if (file_exists($picture = public_path() . $user->picture)){
                unlink($picture);
            }

        }
        $user->update($input);
        session()->flash('updated', 'User "' . $user->name . '" was successfully updated');
        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        //
        if (file_exists($picture = public_path() . $user->picture)){
            unlink($picture);
        }
        $posts = $user->posts;
        \Auth::user()->posts()->saveMany($posts);
        $user->delete();
        session()->flash('deleted', 'Post was successfully deleted');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the picture for specified resource from storage.
     *
     */
    public function destroyPicture($user_id){
        # code
        $user = User::findOrFail($user_id);
        $this->authorize('update', $user);
        if (file_exists($picture = public_path() . $user->picture)){
            unlink($picture);
            session()->flash('deleted', 'Picture for post: "' . $user->name . '" was successfully deleted');
        }
        $user->update(['picture'=>null]);
        return redirect()->route('admin.posts.index');
    }
}
