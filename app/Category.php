<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'user_id','name',
    ];

    public function user()
   {
       return belongsTo('App\User');
   }

   public function blogs()
   {
        return $this->belongsToMany('App\Blog','blog_categories','category_id', 'blog_id');
   }
}
