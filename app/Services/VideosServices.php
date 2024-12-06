<?php

namespace App\Services;

use App\Models\Video;

class VideosServices
{
    public function __construct() {
    }

    public function registrarVideo(Video $video): bool
    {
        $video->save();
        return true;
    }

}
?>
