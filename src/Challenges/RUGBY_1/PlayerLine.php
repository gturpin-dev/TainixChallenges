<?php

namespace Gturpin\TainixChallenges\Challenges\RUGBY_1;

/**
 * Modelize the Player's line in a SCRUM
 */
enum PlayerLine : string {
	case FIRST_LINE  = 'line1';
	case SECOND_LINE = 'line2';
	case THIRD_LINE  = 'line3';

	/**
	 * Get the impact factor of the line
	 *
	 * @return float The impact factor
	 */
	public function get_impact_factor() : float {
		return match( $this ) {
			self::FIRST_LINE  => 1.5,
			self::SECOND_LINE => 1,
			self::THIRD_LINE  => .75,
		};
	}
}