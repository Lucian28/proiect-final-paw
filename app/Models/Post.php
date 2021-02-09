<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use willvincent\Rateable\Rateable;
use Laravelista\Comments\Commentable;

class Post extends Model
{
    use HasFactory, Commentable,Rateable;
    protected $table='continut';
    public $primaryKey='id';
    public $timestamps=true;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function rating()
{
  return $this->hasMany(Rating::class);
}


}
