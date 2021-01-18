<?php

namespace Devanny\QuickBlog\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function nextPost()
    {
        return Post::where('id', '>', $this->id)->orderBy('id','asc')->first();
    }

    public function recentPost()
    {
        return Post::orderBy('id','desc')->get()->take(4);
    }

    public function getCategoryAttribute($value)
    {
       
            return json_decode($value, true);
    
    }

    public function getCreatedAtAttribute($value){
     return Carbon::createFromFormat('Y-m-d H:i:s', $value)->diffForHumans();
    }

}
