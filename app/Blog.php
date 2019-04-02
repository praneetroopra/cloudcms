<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'user_id','title', 'headerImage', 'body','galleryImages','slug'
    ];
    public function setGalleryImagesAttribute($data)
    {
        $this->attributes['galleryImages'] = !is_null($data) && is_array($data) ? json_encode($data) : null;
    }

   public function user()
   {
       return $this->belongsTo('App\User');
   }

   public function categories()
   {
       return $this->belongsToMany('App\Category','blog_categories','blog_id','category_id')->orderBy('name');
   }

   public function galleries()
   {
       return $this->hasMany('App\PostGallery');
   }
}
