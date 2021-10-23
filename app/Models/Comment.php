<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['post_id', 'user_id', 'content', 'parent_id'];
    protected $date = ['deleted_at'];


    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function post(){
        return $this->belongsTo('App\Models\post', 'post_id', 'id');
    }
    public function comment(){
        return $this->hasMany('App\Models\Comment', 'parent_id');
    }
}
