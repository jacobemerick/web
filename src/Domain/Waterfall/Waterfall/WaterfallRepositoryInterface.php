<?php

namespace Jacobemerick\Web\Domain\Waterfall\Waterfall;

interface WaterfallRepositoryInterface
{
    public function getWaterfalls($limit = null, $offset= 0);
}
