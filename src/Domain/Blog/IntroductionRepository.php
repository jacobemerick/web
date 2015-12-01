<?php

namespace Jacobemerick\Web\Domain\Blog;

interface IntroductionRepository
{
    public function findByType($type, $value = '');
}
