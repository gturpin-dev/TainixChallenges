<?php

namespace Gturpin\TainixChallenges\Challenges\SURVIVAL_2;

final class Island {

	private array $regions;

	public function __construct( array $regions ) {
		$this->regions = $regions;
	}

	/**
	 * Get the regions of the island
	 *
	 * @return array
	 */
	public function get_regions() : array {
		return $this->regions;
	}
}