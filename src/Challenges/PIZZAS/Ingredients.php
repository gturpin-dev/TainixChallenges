<?php

namespace Gturpin\TainixChallenges\Challenges\PIZZAS;

use Gturpin\TainixChallenges\Challenges\PIZZAS\Ingredient;

/**
 * Modelize a list of Ingredient
 * It is unique so we use the singleton pattern
 */
final class Ingredients {
	
	public static ?self $_instance = null;

	private function __construct(
		private array $ingredients
	) {}

	// prevent cloning
	private function __clone() {}

	public static function get_instance() : self {
		if ( is_null( self::$_instance ) ) {
			throw new \Exception( 'Ingredients must be initialized before use' );
		}

		return self::$_instance;
	}

	/**
	 * Initialize the ingredients with the given list
	 * Format the list to get Ingredient objects
	 *
	 * @param array<string> $ingredients
	 *
	 * @return void
	 */
	public static function init( array $ingredients ) : void {
		// Transform the ingredients array into an array of Ingredient objects
		$ingredients = array_map( fn( $ingredient ) => Ingredient::decode_ingredient( $ingredient ), $ingredients );

		// Set the ingredients name as key
		$ingredients = array_combine( array_map( fn( $ingredient ) => $ingredient->get_name(), $ingredients ), $ingredients );

		self::$_instance = new self( $ingredients );
	}

	/**
	 * Return the list of ingredients
	 *
	 * @return array<Ingredient>
	 */
	public function get_ingredients() {
		return $this->ingredients;
	}
}