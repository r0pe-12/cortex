<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    //

    public function index(){
        # code
        $posts = Post::latest()->where('published_at', '<=', now('Europe/Belgrade'))->paginate(4);
        return view('public.index', compact('posts'));
    }

//    showing single post
    public function showOne($slug){
        # code
        $post = Post::findBySlugOrFail($slug);
        $this->authorize('view', $post);
        return view('public.post', compact('post'));
    }
//    END-showing single post

//    showing about page
    public function about(){
        # code
        $owner = User::where('admin', '=', 1)->first();
        return view('public.about', compact('owner'));
    }
//    END-showing about page

//    showing contact page
    public function contact(){
        # code
        return view('public.contact');
    }
//    END-showing contact page
//    sending mail
    public function mailer(Request $request){
        # code
//        dd($request->all());
        $input = $this->validate($request, [
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'message'=>'required|max:3000',
            recaptchaFieldName() => recaptchaRuleName(),
        ]);
        $data = [
            'name'=>$input['name'],
            'title'=>'Laravel Blog-Post Project',
            'content'=>$input['message'],
            'email'=>$input['email'],
            'phone'=>$input['phone']
        ];
        \Mail::send('mail', $data, function ($message) use ($data) {
            $message->subject('Blog-Post')->from($data['email'], $data['name'])->to('r0pe@protonmail.com', 'Petar Simonovic');
        });
        session()->flash('mail-sent', 'Mail was sent successfully');
        return back();
    }
//    END-sending mail
}
