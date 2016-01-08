<?php

namespace Jacobemerick\Web\Domain\Stream\Activity;

interface ActivityRepositoryInterface
{
    public function getActivityById($id);
    public function getActivities($limit = null, $offset = 0);
    public function getActivitiesCount();
    public function getActivitiesByType($type, $limit = null, $offset = 0);
    public function getActivitiesByTypeCount($type);
}
