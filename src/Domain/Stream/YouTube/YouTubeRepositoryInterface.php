<?php

namespace Jacobemerick\Web\Domain\Stream\YouTube;

interface YouTubeRepositoryInterface
{
    public function getYouTubeById($id);
    public function getYouTubeByVideoId($videoId);
    public function getUnmappedYouTubes();
}
