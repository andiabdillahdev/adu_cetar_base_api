<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
     protected $fillable = [
        'id_category_blog',
        'id',
        'title',
        'date',
        'body'
    ];

    public function CategoryBlog(){
        return $this->hasOne(CategoryBlog::class,'id','id_category_blog');
    }
}
