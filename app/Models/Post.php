<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['product_id', 'user_id', 'content'];
    protected $date = ['deleted_at'];


    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
    public function comment(){
        return $this->hasMany('App\Models\Comment', 'post_id', 'id')->whereNull('parent_id');
    }

}
