<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const CREATED_AT = 'published_at';
    const UPDATED_AT = null;
    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers;

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

    //    accessor for post image
    public function getPictureAttribute($path){
        # code
        if ($path){
            return '/storage/posts/' . $path;
        }
        return 'https://via.placeholder.com/900x900.png/280137?text=NO%20PHOTO';
    }
//    END-accessor for post image

}
