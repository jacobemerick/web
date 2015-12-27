<?php

namespace Jacobemerick\Web\Domain\Stream\Blog;

interface BlogRepositoryInterface
{
    public function getBlogById($id);
    public function getBlogByTitle($title);
    public function getUnmappedBlogs();
}
