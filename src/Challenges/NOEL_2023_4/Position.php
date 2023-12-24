<?php

namespace Gturpin\TainixChallenges\Challenges\NOEL_2023_4;

/**
 * Modelize a position with X and Y coordinates
 */
final readonly class Position {
    public function __construct(
        public int $x,
        public int $y
    ) {}
}
