<?php

namespace Gturpin\TainixChallenges\Challenges\PIZZAS\Pizzaiolos;

use Gturpin\TainixChallenges\Challenges\PIZZAS\Pizza;
use Gturpin\TainixChallenges\Challenges\PIZZAS\Pizzaiolo;

final class Michelangelo extends Pizzaiolo {

	/**
	 * Take the sum of the 2 most expensive ingredients and multiply it by 3
	 * 
	 * @param Pizza $pizza
	 *
	 * @return integer
	 */
	public function prepare_pizza( Pizza $pizza ) : int {
		$ingredients = $pizza->get_ingredients();
		$price       = 0;

		// sort ingredients by the most expensive first
		usort( $ingredients, fn( $a, $b ) => $b->get_price() <=> $a->get_price() );

		// get the 2 most expensive ingredients
		for ( $i = 0; $i < 2; $i++ ) {
			$ingredient = array_shift( $ingredients );

			if ( ! $ingredient ) {
				throw new \Exception( 'Not enough ingredients' );
			}

			$price += $ingredient?->get_price();
		}
		
		return $price * 3;
	}
}