<?php

namespace Gturpin\TainixChallenges\Challenges\NOEL_2023_2;

final class Kid {
	public function __construct(
		protected readonly string $name,
		protected readonly int $fear_factor,
	) {}

	/**
	 * Parse raw data to create a Kid
	 *
	 * @param string $raw_data The raw data
	 */
	public static function from_raw( string $raw_data ) : self {
		[$name, $fear_factor] = explode( '_', $raw_data );

		return new self( $name, $fear_factor );
	}

	public function get_fear_factor() : int {
		return $this->fear_factor;
	}

	public function get_first_letter() : string {
		return substr( $this->name, 0, 1 );
	}
}