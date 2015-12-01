<?php

namespace Jacobemerick\Web\Domain\Blog;

interface TagRepository
{
    public function findTagByTitle($title);
    public function getAllTags();
    public function getTagCloud();
    public function getTagsForPost($post);
}
