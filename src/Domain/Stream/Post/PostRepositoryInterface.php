<?php

namespace Jacobemerick\Web\Domain\Stream\Post;

interface PostRepositoryInterface
{
    public function getPostById($id);
    public function getPostByType($type, $type_id);
    public function getPosts($limit = null, $offset = 0);
    public function getPostsCount();
    public function getPostsByTag($tag, $limit = null, $offset = 0);
    public function getPostsByTagCount($tag);
}
