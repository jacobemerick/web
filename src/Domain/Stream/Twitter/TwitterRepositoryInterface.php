<?php

namespace Jacobemerick\Web\Domain\Stream\Twitter;

interface TwitterRepositoryInterface
{
    public function getTwitterById($id);
    public function getUnmappedTwitters();
}
