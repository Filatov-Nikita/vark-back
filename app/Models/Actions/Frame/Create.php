<?php

namespace App\Models\Actions\Frame;

use App\Models\DataTransferObjects\Frame\CreateData as CreateFrameData;
use App\Models\Frame;

class Create
{
    public function __invoke(CreateFrameData $data): Frame
    {
        $pathOnDisk = $this->storeFile($data);

        return $this->createFrame($data, $pathOnDisk);
    }

    private function storeFile(CreateFrameData $data): string
    {
        $result = $data->file->store($data->directory, $data->disk);

        if ($result === false) {
            throw new Exception();
        }

        return $result;
    }

    private function createFrame(
        CreateFrameData $data,
        string $pathOnDisk,
    ): Frame {
        [$width, $height] = getimagesize($data->file->path());

        /** @var Frame $frame */
        $frame = Frame::make();

        $frame->disk = $data->disk;
        $frame->path = $pathOnDisk;
        $frame->size_in_bytes = $data->file->getSize(); // bytes

        $frame->height = $height;
        $frame->width = $width;

        $frame->type = $data->type;
        $frame->media_type = $data->media_type;

        $frame->owner()->associate($data->owner);
        $frame->domain()->associate($data->relatable);

        $frame->save();

        return $frame;
    }
}
