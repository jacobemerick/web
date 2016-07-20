<?php

namespace Jacobemerick\Web\Domain\Comment\Commenter;

interface CommenterRepositoryInterface
{
    public function createCommenter(array $commenter);
    public function getCommenter($commenterId);
    public function getCommenters($page = null, $perPage = null);
}
