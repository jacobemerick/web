<?php

namespace Jacobemerick\Web\Domain\Stream\Changelog;

interface ChangelogRepositoryInterface
{
    public function getChanges($limit = null, $offset = 0);
}
