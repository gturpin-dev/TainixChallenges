<?php

namespace Gturpin\TainixChallenges\Challenges\WALL_E;

use Gturpin\TainixChallenges\Challenges\WALL_E\Exceptions\BatteryDownException;

final class Battery {

	private const MAX = 100;
	private const MIN = 0;
	
	public function __construct(
		private int $current_level
	) {}

	/**
	 * Maybe charge battery if it is under 20%
	 * To charge, Wall-E need to be in a station
	 * To be in a station, Wall-E need to go to the station which cost the same battery level as its speed
	 * He must come back from the station aswell
	 * 
	 * @throws BatteryDownException If the speed is greater than the battery level
	 *
	 * @return boolean True if the battery has been charged, false otherwise
	 */
	public function maybe_charge( int $speed ) : bool {
		if ( $this->is_down() ) throw new BatteryDownException( 'Battery is down' );
		if ( $this->current_level >= 20 ) return false;

		// Not enough battery to go to the station
		if ( $speed >= $this->current_level ) {
			$this->current_level = 0;
			throw new BatteryDownException( 'Battery is down' );
		}

		// We can omit the outward journey, because we will charge and we checked for the amount of battery left before
		$this->current_level = 100;
		$this->consume( $speed );

		return true;
	}
	
	public function is_down() : bool {
		return $this->current_level <= self::MIN;
	}

	public function is_full() : bool {
		return $this->current_level >= self::MAX;
	}

	public function consume( int $amount ) : void {
		$this->current_level -= $amount;
	}
	
	private function charge( int $amount ) : void {
		$this->current_level += $amount;
	}

	public function get_current_level() : int {
		return $this->current_level;
	}
}