<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    // protected $fillable = [
    //     'title',
    //     'description',
    //     'url',
    //     'image'
    // ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    // cek apakah ada image atau tidak
    public function profileImage(){
        return($this->image) ? '/storage/' . $this->image : '/storage/profile/user.png';
    }

    public function followers(){
        return $this->belongsToMany(User::class);
        // return 'following';
    }
}
