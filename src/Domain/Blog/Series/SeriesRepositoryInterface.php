<?php

namespace Jacobemerick\Web\Domain\Blog\Series;

interface SeriesRepositoryInterface
{
    public function getSeriesForPost($post);
}
