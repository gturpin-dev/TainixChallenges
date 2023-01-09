<?php

namespace Gturpin\TainixChallenges\Challenges\PIZZAS;

use Gturpin\TainixChallenges\Challenges\PIZZAS\Ingredient;
use Gturpin\TainixChallenges\Challenges\PIZZAS\Ingredients;

/**
 * Modelize a pizza with its ingredients
 */
final class Pizza {

	public function __construct(
		/**
		 * @var array<Ingredient> $ingredients
		 */
		private array $ingredients
	) {
		$this->ingredients = $ingredients;
	}

	public function get_ingredients() : array {
		return $this->ingredients;
	}

	/**
	 * Create a pizza from a list of ingredients not formatted
	 *
	 * @param string $ingredient_list
	 *
	 * @return self
	 */
	public static function create_from_ingredient_list( string $ingredient_list ) : self {
		$ingredients     = Ingredients::get_instance()->get_ingredients();
		$ingredient_list = explode( ',', $ingredient_list );

		// Get the ingredient object from the ingredient name
		$ingredient_list = array_map( function ( $ingredient ) use ( $ingredients ) {
			return $ingredients[ $ingredient ] ?? null;
		}, $ingredient_list );

		return new static( $ingredient_list );
	}
}