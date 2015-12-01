<?php

namespace Jacobemerick\Web\Domain\Blog;

interface PostRepository
{
    public function findPostByPath($category, $path);
}
