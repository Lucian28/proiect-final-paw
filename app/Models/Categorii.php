<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorii extends Model
{
    use HasFactory;
    protected $table='categorii';
    public $primaryKey='id';

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
