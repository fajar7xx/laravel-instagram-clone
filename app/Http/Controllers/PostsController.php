<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use Intervention\Image\Facades\Image;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = auth()->user()->following()->pluck('user_id');

        // dd($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);
        
        // dd($request->all());
        // nangani nya php artisan storage:link
        // dd(request('image')->store('uploads', 'public'));
        
        $imagePath = request('image')->store('uploads', 'public');

        // resize nya disini
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1080, 1080);
        $image->save();

        $post = new Post();
        $post->user_id = \Auth::user()->id;
        $post->caption = htmlspecialchars($request->caption, ENT_QUOTES);
        $post->image = $imagePath;
        $post->save();

        return redirect('/profile/' . auth()->user()->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
