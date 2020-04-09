<?php

namespace App;

use App\Mail\NewUserWelcomeMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // funsi in yang akan di jalankan dluan pada model ini
    protected static function boot(){
        parent::boot();
        
        // otomatis membuat
        static::created(function($user){
            $user->profile()->create([
                'title' => $user->username,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum autem minus fuga quibusdam fugit rem quia enim sapiente totam incidunt minima quas molestias aut, veritatis eveniet perspiciatis, omnis dignissimos sunt!',
                'image' => 'profile/user.png',
            ]);

            // send and email ere otoamtically
            Mail::to($user->email)->send(new NewUserWelcomeMail());
        });
    }

    
    public function profile(){
        return $this->hasOne(Profile::class);
    }
    
    public function following(){
        // return "following";
        return $this->belongsToMany(Profile::class);
    }
    
    // relations one has many
    public function posts(){
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }
    
}
