<?php

namespace Jacobemerick\Web\Domain\Blog;

interface PostRepository
{
    public function findPostByPath($category, $path);
    public function getActivePosts($limit = null, $offset= 0);
    public function getActivePostsCount();
    public function getActivePostsByTag($tag, $limit = null, $offset = 0);
    public function getActivePostsCountByTag($tag);
    public function getActivePostsByCategory($category, $limit = null, $offset = 0);
    public function getActivePostsCountByCategory($category);
    public function getActivePostsByRelatedTags($post, $limit = 4);
}
