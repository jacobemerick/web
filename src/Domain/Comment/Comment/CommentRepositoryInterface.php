<?php

namespace Jacobemerick\Web\Domain\Comment\Comment;

interface CommentRepositoryInterface
{
    public function getActiveCommentsBySite($site, $limit = null, $offset= 0);
}
