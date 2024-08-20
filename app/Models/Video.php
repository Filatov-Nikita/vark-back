<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Video extends Model
{
    use HasFactory;

    public function video(): MorphOne
    {
        return $this->morphOne(Frame::class, 'domain')->where('type', 'video');
    }
}