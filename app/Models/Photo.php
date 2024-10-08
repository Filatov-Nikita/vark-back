<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function image(): MorphOne
    {
        return $this->morphOne(Frame::class, 'domain')->where('type', 'image');
    }
}
