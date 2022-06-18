<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    retrieving number of users
    public static function count(){
        # code
        return count(User::all());
    }
//    END-retrieving number of users

//    accessor for profile image
    public function getPictureAttribute($path){
        # code
        if ($path){
            return '/storage/images/users/' . $path;
        }
        return 'https://via.placeholder.com/900x900.png/280137?text=NO%20PHOTO';
    }
//    END-accessor for profile image

//  relation between posts and users : user has many posts
    public function posts(){
        # code
        return $this->hasMany(Post::class);
    }
//  END-relation between posts and users : user has many posts
}
