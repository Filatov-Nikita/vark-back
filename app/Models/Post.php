<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
    ];

    public function thumbnail(): MorphOne
    {
        return $this->morphOne(Frame::class, 'domain')->where('type', 'thumbnail');
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Frame::class, 'domain')->where('type', 'image');
    }
}
