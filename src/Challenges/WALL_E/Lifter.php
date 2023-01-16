<?php

namespace Gturpin\TainixChallenges\Challenges\WALL_E;

final class Lifter {


	public function __construct(
		private readonly int $strength,
	) {}

	/**
	 * Get the consumed battery to lift a waste
	 *
	 * @param Waste $waste
	 * @param integer $current_battery
	 *
	 * @return integer The consumed battery
	 */
	public function get_consumed_battery_for_lift( Waste $waste, int $current_battery ) : int {
		// Use strength to collect waste
		if ( $this->strength >= $waste->get_weight() ) {
			return 1;
		}

		// Not enough strength, try to use battery
		// 1 more strength cost 2 battery
		$missing_strength = $waste->get_weight() - $this->strength;
		$needed_battery   = $missing_strength * 2;

		// Can't use more that the half of its current battery to power up
		$max_battery_can_be_used = floor( $current_battery / 2 );

		if ( $needed_battery <= $max_battery_can_be_used ) {
			return $needed_battery;
		}

		return 2;
	}
}