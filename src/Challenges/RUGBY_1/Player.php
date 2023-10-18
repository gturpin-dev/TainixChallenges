<?php

namespace Gturpin\TainixChallenges\Challenges\RUGBY_1;

/**
 * Modelize a Rugby Player
 */
final class Player {
	
	public function __construct(
		private string $line,
		private int $weight,
		private int $strength
	) {}

	/**
	 * The impact is calculated by the following formula :
	 * strength * weight * Line::IMPACT_FACTOR
	 *
	 * @return integer The impact power of the player
	 */
	public function get_impact_power() : int {
		$line_factor = match( $this->line ) {
			'first_line'  => 1.5,
			'second_line' => 1,
			'third_line'  => .75,
			default       => throw new \InvalidArgumentException( 'The line is not valid' ),
		};

		return floor( $this->strength * $this->weight * $line_factor );
	}
}