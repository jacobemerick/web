<?php

namespace Jacobemerick\Web\Domain\Blog\Tag;

interface TagRepositoryInterface
{
    public function findTagByTitle($title);
    public function getAllTags();
    public function getTagCloud();
    public function getTagsForPost($post);
}
