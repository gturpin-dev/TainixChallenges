<?php

namespace Gturpin\TainixChallenges\Challenges\RUGBY_2;

/**
 * Modelize a rugby action and its points
 */
enum Action : string {
	case TRY        = 'E';
	case CONVERSION = 'T';
	case PENALTY    = 'P';
	case DROP       = 'D';

	/**
	 * Get the points of the action
	 *
	 * @return integer The points
	 */
	public function get_points() : int {
		return match ( $this ) {
			Action::TRY        => 5,
			Action::CONVERSION => 2,
			Action::PENALTY    => 3,
			Action::DROP       => 3,
		};
	}
}