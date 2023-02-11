<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'article',
        'image',
        'user_id',
        'category_id'
    ];


    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user() : BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    public function tag() : BelongsToMany 
    {
        return $this->belongsToMany(Tag::class);
    }
}
