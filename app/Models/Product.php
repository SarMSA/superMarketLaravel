<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    //without it softdelete won't work...
    use SoftDeletes;

    protected $fillable = ['name', 'price', 'details', 'user_id'];

    protected $date = ['deleted_at'];

    public function user(){
        return $this->belongsTo('App\Models\user', 'user_id', 'id');
    }

    public function post(){
        return $this->hasMany('App\Model\Post', 'product_id', 'id');
    }
}
