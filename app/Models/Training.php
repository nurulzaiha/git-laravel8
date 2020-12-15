<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    //training belong to user
    //belongTo sebab ada Foreign Key
    public function user(){
        
        return $this->belongsTo('App\Models\User');
    }

}
