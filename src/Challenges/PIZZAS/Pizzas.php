<?php

namespace Gturpin\TainixChallenges\Challenges\PIZZAS;

use Gturpin\TainixChallenges\Challenge;
use Gturpin\TainixChallenges\Challenges\PIZZAS\Pizza;
use Gturpin\TainixChallenges\Challenges\PIZZAS\Ingredient;

/**
 * @link https://tainix.fr/challenge/YOLO-les-Pizzaiolos
 */
final class Pizzas extends Challenge {
	
	private const ENABLE_LOG = true;
	
	public function solve() : mixed {
		$this->data = $this->get_data_test();

		$ingredients        = $this->data['ingredients'];
		$pizzas_ingredients = $this->data['pizzas'];
		$pizzaiolos         = $this->data['pizzaiolos'];
		$total_price        = 0;
		
		echo '<pre>' . print_r( $this->data, true ) . '</pre>';

		// Transform the ingredients array into an array of Ingredient objects
		$ingredients = array_map( function ( $ingredient ) {
			return Ingredient::decode_ingredient( $ingredient );
		}, $ingredients );

		// Set the ingredients name as key
		$ingredients = array_combine( array_map( fn( $ingredient ) => $ingredient->get_name(), $ingredients ), $ingredients );
		
		foreach ( $pizzas_ingredients as $index => $pizza_ingredients ) {

			// Transform the ingredients list into an array of Ingredient objects
			$pizza_ingredients = explode( ',', $pizza_ingredients );
			$pizza_ingredients = array_map( function ( $ingredient ) use ( $ingredients ) {
				return $ingredients[ $ingredient ] ?? null;
			}, $pizza_ingredients );

			// Get the pizzaiolo for this pizza
			$pizzaiolo = $pizzaiolos[ $index ] ?? null;
			self::log( $pizzaiolo );
			$pizzaiolo = Pizzaiolo::create_from_string( $pizzaiolo );
			// self::log( $pizzaiolo->get_name() );
			var_dump( $pizzaiolo );
			self::log( '' );


			$pizzaiolo = $pizzaiolo::get_instance();

			continue;

			if ( is_null( $pizzaiolo ) ) {
				throw new \Exception( 'No pizzaiolo for this pizza' );
			}

			$pizza = new Pizza( $pizza_ingredients );
			$price = $pizzaiolo->prepare_pizza( $pizza );

			self::log( $pizzaiolo->get_name() . ' : ' . $price );

			$total_price += $price;
		}
		var_dump( $total_price );
		die;
		
		die;
	}

	/**
	 * Print something
	 *
	 * @param mixed $result
	 *
	 * @return void
	 */
	public static function log( mixed $string ) : void {
		if ( ! self::ENABLE_LOG ) {
			return;
		}

		echo $string ?: '';
		echo '<br>';
	}
}