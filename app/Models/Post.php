<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'title', 'body', 'iframe', 'image', 'user_id'
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
                'source' => 'title',
                'onUpdate' => true
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
    public function getgetExcerptAttribute()
    {
        return substr($this->body, 0, 140);
    }

    public function getgetImageAttribute()
    {
        if($this->image){
            return url("storage/$this->image");
        }
    }
    
    //Agrega el slug
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
