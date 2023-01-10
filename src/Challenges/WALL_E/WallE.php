<?php

namespace Gturpin\TainixChallenges\Challenges\WALL_E;

use Gturpin\TainixChallenges\Challenges\WALL_E\Exceptions\Wall_E_KOException;

final class WallE {

	public function __construct(
		private readonly int $strength,
		private readonly int $speed,
		private int $battery
	) {}

	public function is_alive() : bool {
		return $this->battery > 0;
	}

	/**
	 * Collect a waste
	 *
	 * @param int $waste Waste weight
	 *
	 * @return boolean True if the waste has been collected, false otherwise
	 */
	public function collect( int $waste ) : bool {
		if ( ! $this->is_alive() ) {
			throw new Wall_E_KOException( 'Wall-E is KO' );
		}

		// Use strength to collect waste
		if ( $this->strength >= $waste ) {
			$this->decrease_battery( 1 );
			return true;
		}

		// Not enough strength, try to use battery
		
		
		return $this->battery > 0;
	}

	/**
	 * Decrease battery level
	 *
	 * @param int $level Battery level to decrease
	 *
	 * @return void
	 */
	private function decrease_battery( int $level ) : void {
		$this->battery -= $level;

		if ( $this->battery < 0 ) {
			$this->battery = 0;
			throw new Wall_E_KOException( 'Wall-E is KO' );
		}
	}
}