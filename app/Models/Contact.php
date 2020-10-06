<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = "contacts";
    protected $fillable = [
        "user_id",
        "link_whatsapp",
        "link_instagram",
        "link_telegram",
        "link_facebook"
    ];
    public function user()
    {
        return $this->belongsTo(User::class, "id", "user_id");
    }
}
