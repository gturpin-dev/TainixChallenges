<?php

namespace Gturpin\TainixChallenges\Challenges\WALL_E;

/**
 * Modelize a waste
 */
final class Waste {

	public function __construct(
		private readonly int $weight,
	) {}

	public function get_weight() : int {
		return $this->weight;
	}
}