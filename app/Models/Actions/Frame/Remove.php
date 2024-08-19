<?php

namespace App\Models\Actions\Frame;

use App\Models\Frame;
use Illuminate\Support\Facades\Storage;

class Remove
{
    public function __invoke(Frame $frame): void
    {
        Storage::disk($frame->disk)->delete($frame->path);
        $frame->delete();
    }
}
