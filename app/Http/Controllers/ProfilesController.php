<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        // dd($user);
        // $user = User::findOrFail($user);
        // dd($user);
        $profile = User::findOrFail($user->id)->profile;
        // dd($profile);

        // jika follow true kalau kgak y false 
        // $follows = (Auth::user()) ? true : false;
        $follows = (auth()->user()) ? auth()->user()->following->contains($profile->id) : false ;
        // Auth::user()->following->contains($user->id)
        // dd($follows);

        $postCount = Cache::remember(
            'count.posts'. $user->id, 
            now()->addSeconds(30), 
            function() use($user){
            return $user->posts->count();
        });

        return view('profiles.index', [
            'user' => $user,
            'follows' => $follows,
            'postCount' => $postCount,
        ]);
    }

    public function edit($user){

        $user = User::findOrFail($user);
        $this->authorize('update', $user->profile);

        return view('profiles.edit', [
            'user' => $user,
        ]);

    }

    public function update(Request $request, $id){
        $profileData = Profile::findOrFail($id);
        $user_id = $profileData->user_id;
        $user = User::findOrFail($user_id);
        
        $this->authorize('update', $user->profile);

        $validateData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => 'image'
        ]);
        
        
        $profileData->title = $request->title;
        $profileData->description = $request->description;
        $profileData->url = $request->url;

        if($request->hasFile('image')){
            $imagePath = request('image')->store('profile', 'public');

            // resize nya disini
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1080, 1080);
            $image->save();
            $profileData->image = $imagePath;
        }
        $profileData->save();

        return redirect()->route('profile.show', $user_id);
    }
}
