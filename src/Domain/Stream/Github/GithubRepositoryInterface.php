<?php

namespace Jacobemerick\Web\Domain\Stream\Github;

interface GithubRepositoryInterface
{
    public function getEvents($limit = null, $offset = 0);
    public function getEventByEventId($eventId);
}
