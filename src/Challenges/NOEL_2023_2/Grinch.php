<?php

namespace Gturpin\TainixChallenges\Challenges\NOEL_2023_2;

final class Grinch {
	public const TIME_TO_FEAR = 3;
	public const TIME_WHEN_NOT_SCARED = 2;
	
	public function __construct(
		protected readonly int $fear_factor,
		protected int $time_left,
	) {}

	/**
	 * Try to fear a Kid
	 * Loss time, but more if not scared
	 *
	 * @param Kid $kid The kid to fear
	 */
	public function try_fear( Kid $kid ) : bool {
		$this->time_left -= self::TIME_TO_FEAR;
		
		if ( $this->fear_factor > $kid->get_fear_factor() ) {
			return true;
		}

		$this->time_left -= self::TIME_WHEN_NOT_SCARED;
		return false;
	}

	public function get_time_left() : int {
		return $this->time_left;
	}
}