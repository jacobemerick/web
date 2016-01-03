<?php

namespace Jacobemerick\Web\Domain\Stream\DailyMile;

interface DailyMileRepositoryInterface
{
    public function getEntries($limit = null, $offset = 0);
    public function getEntryByEntryId($entryId);
}
