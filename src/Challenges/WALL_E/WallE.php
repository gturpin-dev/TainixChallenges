<?php

namespace Gturpin\TainixChallenges\Challenges\WALL_E;

use Gturpin\TainixChallenges\Challenge;
use Gturpin\TainixChallenges\Challenges\WALL_E\Waste;
use Gturpin\TainixChallenges\Challenges\WALL_E\Lifter;
use Gturpin\TainixChallenges\Challenges\WALL_E\Battery;
use Gturpin\TainixChallenges\Challenges\WALL_E\Exceptions\Wall_E_KOException;
use Gturpin\TainixChallenges\Challenges\WALL_E\Exceptions\BatteryDownException;

final class WallE {

	private Battery $battery;
	private Lifter $lifter;
	
	public function __construct(
		private readonly int $speed,
		int $current_battery,
		int $strength,
	) {
		$this->battery = new Battery( $current_battery );
		$this->lifter  = new Lifter( $strength );
	}

	public function is_alive() : bool {
		return ! $this->battery->is_down();
	}

	public function get_battery_level() {
		return $this->battery->get_current_level();
	}

	/**
	 * Collect a waste
	 *
	 * @param Waste $waste The waste to collect
	 * 
	 * @throws Wall_E_KOException If Wall-E is KO and can't collect waste
	 *
	 * @return void
	 */
	public function collect( Waste $waste ) : void {
		if ( $this->battery->is_down() ) {
			throw new Wall_E_KOException( 'Wall-E is KO' );
		}

		try {
			$current_battery  = $this->battery->get_current_level();
			$consumed_battery = $this->lifter->get_consumed_battery_for_lift( $waste, $current_battery );

			$this->battery->consume( $consumed_battery );
			$this->battery->maybe_charge( $this->speed );
		} catch ( BatteryDownException $e ) {
			throw new Wall_E_KOException( 'Wall-E is KO' );
		}
	}

	/**
	 * Maybe charge the battery
	 *
	 * @return boolean
	 */
	public function maybe_charge() : bool {
		return $this->battery->maybe_charge( $this->speed );
	}
}