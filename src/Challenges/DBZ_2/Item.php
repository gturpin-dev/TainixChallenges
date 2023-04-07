<?php

namespace Gturpin\TainixChallenges\Challenges\DBZ_2;

class Item {

	/**
	 * Item code
	 *
	 * @var string
	 */
	public readonly string $code;

	/**
	 * Item weight
	 *
	 * @var integer
	 */
	public readonly int $weight;

	public function __construct( 
		public readonly string $representation
	) {
		$this->check_validity();
		$this->init();
	}

	/**
	 * Initialize Item properties
	 *
	 * @return void
	 */
	private function init() : void {
		[ $this->code, $this->weight ] = explode( '-', $this->representation );
	}

	/**
	 * Check if the Item representation is valid
	 * Rules are :
	 *  - code must be at least 4 characters long
	 *  - separator with dash (-)
	 *  - Item weight must be numeric
	 * 
	 * @throws \InvalidArgumentException If the representation is invalid
	 *
	 * @return void
	 */
	private function check_validity(): void {
		if ( ! str_contains( $this->representation, '-' ) ) {
			throw new \InvalidArgumentException( 'Invalid object representation of item : ' . $this->representation . ' (missing dash)');
		}

		[ $code, $weight ] = explode( '-', $this->representation );

		if ( strlen( $code ) < 4 ) {
			throw new \InvalidArgumentException( 'Invalid object representation of item : ' . $this->representation . ' (code must be at least 4 characters long)');
		}

		if ( ! is_numeric( $weight ) ) {
			throw new \InvalidArgumentException( 'Invalid object representation of item : ' . $this->representation . ' (weight must be numeric)');
		}
	}

	// public function __toString(): string {
	// 	return $this->representation;
	// }

	/**
	 * Get item weight
	 *
	 * @return  integer
	 */ 
	public function get_weight() {
		return $this->weight;
	}

	/**
	 * Get item code
	 *
	 * @return  string
	 */ 
	public function get_code() {
		return $this->code;
	}
}