<?php

namespace Jacobemerick\Web\Domain\Portfolio\Piece;

interface PieceRepositoryInterface
{
    public function getPieces($limit = null, $offset= 0);
}
