<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    //tambah fillable property utk update data
    protected $fillable = ['title','description','trainer','attachment'];

    //training belong to user
    //belongTo sebab ada Foreign Key
    public function user(){
        
        return $this->belongsTo('App\Models\User');
    }
//getter $training->attachment_url
    public function getAttachmentUrlAttribute()
{
    if ($this->attachment){
    return asset('storage/'.$this->attachment);
}else{
    return 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fen.wikipedia.org%2Fwiki%2FFile%3ANo_image_available.svg&psig=AOvVaw1OqxLWe8RGk1NwP62z1Pxq&ust=1608696989609000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCPCFv7fd4O0CFQAAAAAdAAAAABAD';
}
}

}
