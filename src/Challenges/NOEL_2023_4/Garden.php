<?php

namespace Gturpin\TainixChallenges\Challenges\NOEL_2023_4;

/**
 * A garden is a grid with traps on it
 */
final class Garden extends Grid {
	public function __construct(
		/**
		 * The grid representing the garden
		 *
		 * @var Grid
		 */
		protected Grid $grid,
		
		/**
		 * The traps in the garden
		 * 
		 * @var array<Trap>
		 */
		protected array $traps,
	) {}

	/**
	 * Get the traps at a given position
	 *
	 * @param Position $position The position to check
	 */
	public function get_traps_at( Position $position ) : array {
		return array_filter( $this->traps, fn( Trap $trap ) => in_array( $position, $trap->get_positions() ) );
	}
}