<?php

namespace Jacobemerick\Web\Domain\Stream\Distance;

use DateTimeInterface;

interface DistanceRepositoryInterface
{
    public function getDistanceById($id);
    public function getDistanceByFields(DateTimeInterface $date, $type, $mileage);
    public function getUnmappedDistances();
}
