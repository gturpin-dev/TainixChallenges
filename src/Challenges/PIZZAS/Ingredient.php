<?php

namespace Gturpin\TainixChallenges\Challenges\PIZZAS;

/**
 * Modelize an ingredient for a pizza
 */
final class Ingredient {

	public function __construct(
		private readonly string $name,
		private readonly int $price
	) {}

	/**
	 * Create an ingredient from a string like "Tomato:1"
	 *
	 * @param string $ingredient
	 *
	 * @return self
	 */
	public static function decode_ingredient( string $ingredient ) : self {
		[ $ingredient_name, $ingredient_price ] = explode( ':', str_pad( $ingredient, 2, ':' ) );

		return new self( strtolower( $ingredient_name ), (int) $ingredient_price );
	}

	public function get_name() : string {
		return $this->name;
	}

	public function get_price() : int {
		return $this->price;
	}
}