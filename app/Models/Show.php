<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'title', 'slug', 'description', 
        'youtube_url', 'meta_title', 'meta_description', 'cover_image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
