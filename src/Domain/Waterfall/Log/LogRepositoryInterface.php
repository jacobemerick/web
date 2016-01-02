<?php

namespace Jacobemerick\Web\Domain\Waterfall\Log;

interface LogRepositoryInterface
{
    public function getActiveLogs($limit = null, $offset= 0);
}
