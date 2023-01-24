<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryBlog extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'category',
        'slug'
    ];

    public function Blog(){
        return $this->belongsTo(Blog::class,'id_category_blog','id');
    }
}
