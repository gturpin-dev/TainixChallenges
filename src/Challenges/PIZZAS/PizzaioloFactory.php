<?php

namespace Gturpin\TainixChallenges\Challenges\PIZZAS;

use Gturpin\TainixChallenges\Challenges\PIZZAS\Pizzaiolo;

/**
 * Factory to get instance of the right pizzaiolos
 */
final class PizzaioloFactory {
	
	/**
	 * Get the right pizzaiolo instance
	 *
	 * @param string $pizzaiolo_name
	 *
	 * @return Pizzaiolo
	 */
	public static function engage( string $pizzaiolo_name ) : Pizzaiolo {
		$pizzaiolo_name = ucfirst( strtolower( $pizzaiolo_name ) );
		// replace every special character by its normal version (é => e)
		$pizzaiolo_name = iconv( 'UTF-8', 'ASCII//TRANSLIT', $pizzaiolo_name );
		$class_name     = __NAMESPACE__ . '\\Pizzaiolos\\' . $pizzaiolo_name;

		if ( ! class_exists( $class_name ) ) {
			throw new \Exception( 'Pizzaiolo : "' . $pizzaiolo_name . '" not found' );
		}

		if ( ! is_subclass_of( $class_name, Pizzaiolo::class ) ) {
			throw new \Exception( 'Pizzaiolo : "' . $pizzaiolo_name . '" is not a pizzaiolo' );
		}

		return $class_name::get_instance();
	}

	/**
	 * Get the right pizzaiolo instance from its index
	 * 
	 * @param int $index the index of the pizzaiolo in $pizzaiolos
	 * @param array $pizzaiolos the list of pizzaiolos not formatted
	 * 
	 * @return Pizzaiolo
	 */
	public static function create_from_index( int $index, array $pizzaiolos ) {
		$pizzaiolo_name = $pizzaiolos[ $index ] ?? null;

		if ( is_null( $pizzaiolo_name ) ) {
			throw new \Exception( 'No pizzaiolo for this pizza' );
		}

		return self::engage( $pizzaiolo_name );
	}
}