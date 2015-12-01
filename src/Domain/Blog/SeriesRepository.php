<?php

namespace Jacobemerick\Web\Domain\Blog;

interface SeriesRepository
{
    public function getSeriesForPost($post);
}
