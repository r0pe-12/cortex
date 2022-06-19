<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const CREATED_AT = 'published_at';
    const UPDATED_AT = 'updated_at';
    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers;
    protected $fillable = [
      'title',
      'slug',
      'short_description',
      'content',
      'picture',
      'published_at'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

//    retrieving number of posts
    public static function count(){
        # code
        return count(Post::all());
    }
//    END-retrieving number of posts

    //    accessor for post image
    public function getPictureAttribute($path){
        # code
        if (strpos($path, 'http://') !== FALSE || strpos($path, 'https://') !== FALSE){
            return $path;
        }

        if ($path){
            if (file_exists(public_path() . '/storage/images/posts/' . $path)){
                return '/storage/images/posts/' . $path;
            }
            return 'https://via.placeholder.com/900x900.png/ff0000/000000?text=NO%20PHOTO';
        }
        return asset('startbootstrap/assets/blurry-gradient-haikei.svg');
    }
//    END-accessor for post image

//  retrieving the post owner
    public function user(){
        # code
        return $this->belongsTo(User::class);
    }
//  END-retrieving the post owner
}
