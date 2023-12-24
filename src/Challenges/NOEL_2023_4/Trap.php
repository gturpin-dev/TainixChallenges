<?php

namespace Gturpin\TainixChallenges\Challenges\NOEL_2023_4;

use Gturpin\TainixChallenges\Challenges\NOEL_2023_4\Position;

final class Trap {
	/**
	 * The positions of the trap
	 * 
	 * @var array<Position>
	 */
	protected array $positions;
	
	public function __construct(
		protected readonly string $id,
		
		/**
		 * The size of the trap ( 1 to 3 )
		 * A trap is a square of size * size
		 */
		protected readonly int $size,

		/**
		 * The position of the trap starting from the bottom left corner
		 */
		Position $start_position,
	) {
		$this->init_positions( $start_position );
	}

	/**
	 * Create the positions of the trap based on its size and start position
	 */
	protected function init_positions( Position $start_position ) : void {
		$size            = $this->size;
		$y               = $start_position->y;
		$x               = $start_position->x;
		
		for ( $i = 0; $i < $size; $i++ ) {
			for ( $j = 0; $j < $size; $j++ ) {
				$this->positions[] = new Position( $x + $j, $y + $i );
			}
		}
	}

	/**
	 * Parse the raw data to create a new instance of Trap
	 *
	 * @param string $raw_data The raw data of the trap
	 */
	public static function from_raw( string $raw_data ) : self {
		[ $id, $size, $position ] = explode( ':', $raw_data );
		[ $x, $y ]                = explode( ';', $position );

		return new self( $id, (int) $size, new Position( (int) $x, (int) $y ) );
	}

	/**
	 * Get the positions of the trap
	 * 
	 * @return array<Position>
	 */
	public function get_positions() : array {
		return $this->positions;
	}

	/**
	 * Get the id of the trap
	 */
	public function get_id() : string {
		return $this->id;
	}
}