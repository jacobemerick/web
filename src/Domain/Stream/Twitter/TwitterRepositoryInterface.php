<?php

namespace Jacobemerick\Web\Domain\Stream\Twitter;

use DateTimeInterface;

interface TwitterRepositoryInterface
{
    public function getTwitterById($id);
    public function getTwitterByFields(DateTimeInterface $date, $text);
    public function getUnmappedTwitters();
}
