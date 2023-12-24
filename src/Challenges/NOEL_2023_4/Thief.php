<?php

namespace Gturpin\TainixChallenges\Challenges\NOEL_2023_4;

/**
 * A thief is a person who can move in a garden
 */
final class Thief {
	public function __construct(
		/**
		 * The position of the thief
		 */
		protected Position $position,
	) {}

	/**
	 * Move the thief in the garden
	 *
	 * @param Direction $direction The direction to move the thief
	 */
	public function move( Direction $direction ) : void {
		match ( $direction ) {
			Direction::TOP    => $this->position = new Position( $this->position->x, $this->position->y + 1 ),
			Direction::RIGHT  => $this->position = new Position( $this->position->x + 1, $this->position->y ),
			Direction::BOTTOM => $this->position = new Position( $this->position->x, $this->position->y - 1 ),
			Direction::LEFT   => $this->position = new Position( $this->position->x - 1, $this->position->y ),
		};
	}

	public function get_position() : Position {
		return $this->position;
	}
}