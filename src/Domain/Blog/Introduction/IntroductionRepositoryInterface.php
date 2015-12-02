<?php

namespace Jacobemerick\Web\Domain\Blog\Introduction;

interface IntroductionRepositoryInterface
{
    public function findByType($type, $value = '');
}
