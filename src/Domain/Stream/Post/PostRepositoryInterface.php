<?php

namespace Jacobemerick\Web\Domain\Stream\Post;

interface PostRepositoryInterface
{
    public function getPostById($id);
    public function getPostByFields($type, $type_id);
    public function getPosts($limit = null, $offset = 0);
    public function getPostsCount();
    public function getPostsByType($type, $limit = null, $offset = 0);
    public function getPostsByTypeCount($type);
}
