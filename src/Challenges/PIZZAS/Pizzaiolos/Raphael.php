<?php

namespace Gturpin\TainixChallenges\Challenges\PIZZAS\Pizzaiolos;

use Gturpin\TainixChallenges\Challenges\PIZZAS\Pizza;
use Gturpin\TainixChallenges\Challenges\PIZZAS\Pizzaiolo;

final class Raphael extends Pizzaiolo {

	/**
	 * Start at 10 and add the most expensive ingredient and the less expensive ingredient
	 * 
	 * @param Pizza $pizza
	 *
	 * @return integer
	 */
	public function prepare_pizza( Pizza $pizza ) : int {
		$ingredients = $pizza->get_ingredients();

		if ( count( $ingredients ) < 2 ) {
			throw new \Exception( 'Not enough ingredients' );
		}
		
		$ingredients = array_map( fn( $ingredient ) => $ingredient->get_price(), $ingredients );
		$price       = 10 + max( $ingredients ) + min( $ingredients );

		return $price;
	}
}