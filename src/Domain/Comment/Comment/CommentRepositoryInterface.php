<?php

namespace Jacobemerick\Web\Domain\Comment\Comment;

interface CommentRepositoryInterface
{
    public function createComment(array $comment);
    public function getComment($commentId);
    public function getComments($domain = null, $path = null, $page = null, $perPage = null, $order = null);
}
