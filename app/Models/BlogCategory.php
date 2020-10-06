<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $table = "blog_categorys";
    protected $fillable = ["category_name"];
    public function blog()
    {
        return $this->hasMany(Blog::class);
    }
}
