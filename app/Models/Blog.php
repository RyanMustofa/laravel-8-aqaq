<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = "blogs";
    protected $fillable = [
        "user_id",
        "title",
        "content",
        "blog_category_id",
        "cover",
        "status",
        "slug"
    ];
    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class,'id','blog_category_id');
    }
}
