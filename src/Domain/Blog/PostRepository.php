<?php

namespace Jacobemerick\Web\Domain\Blog;

interface PostRepository
{
    public function findByPath($category, $path);
}
