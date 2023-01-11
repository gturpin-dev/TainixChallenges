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
	 * @throws Wall_E_KOException If Wall-E is KO and can't collect waste
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
		// 1 more strength cost 2 battery
		$missing_strength = $waste - $this->strength;
		$needed_battery   = $missing_strength * 2;

		// Can't use more that the half of its current battery to power up
		$max_battery_can_be_used = floor( $this->battery / 2 );
		
		// Can use battery if needed battery is less than max battery can be used
		if ( $needed_battery <= $max_battery_can_be_used ) {
			$this->decrease_battery( $needed_battery );
			return true;
		}

		// Not enough battery, only lost 2 battery and can't collect waste
		$this->decrease_battery( 2 );
		
		return false;
	}

	/**
	 * Maybe charge battery if it is under 20%
	 * To charge, Wall-E need to be in a station
	 * To be in a station, Wall-E need to go to the station which cost the same battery level as its speed
	 * He must come back from the station aswell
	 * 
	 * @throws Wall_E_KOException If the speed is greater than the battery level
	 *
	 * @return boolean True if the battery has been charged, false otherwise
	 */
	public function maybe_charge() {
		if ( $this->battery >= 20 ) return false;

		// Not enough battery to go to the station
		if ( $this->speed >= $this->battery ) {
			$this->battery = 0;
			throw new Wall_E_KOException( 'Wall-E is KO' );
		}
		
		// We can omit the outward journey, because we will charge and we checked for the amount of battery left before
		$this->battery = 100;
		$this->decrease_battery( $this->speed );

		return true;
	}

	/**
	 * Decrease battery level
	 *
	 * @param int $level Battery level to decrease
	 * 
	 * @throws Wall_E_KOException If battery is under 0
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

	public function get_battery_level() {
		return $this->battery;
	}
}