<?php

namespace Gturpin\TainixChallenges\Challenges\RUGBY_1;

use Gturpin\TainixChallenges\Challenges\RUGBY_1\PlayerLine;

/**
 * Modelize a Rugby Player
 */
final class Player {
	
	public function __construct(
		private PlayerLine $line,
		private int $weight,
		private int $strength
	) {}

	/**
	 * The impact is calculated by the following formula :
	 * strength * weight * impact factor of the line
	 *
	 * @return integer The impact power of the player
	 */
	public function get_impact_power() : int {
		return (int) floor( $this->strength * $this->weight * $this->line->get_impact_factor() );
	}
}