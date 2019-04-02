<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostGallery extends Model
{
   public function blogs()
   {
       return $this->belongsTo('App\Blog');
   }
}
