<?php

namespace Gturpin\TainixChallenges\Challenges\PIZZAS\Pizzaiolos;

use Gturpin\TainixChallenges\Challenges\PIZZAS\Pizza;
use Gturpin\TainixChallenges\Challenges\PIZZAS\Pizzaiolo;

final class Donatello extends Pizzaiolo {

	/**
	 * Multiply the most expensive ingredient by 5
	 * 
	 * @param Pizza $pizza
	 *
	 * @return integer
	 */
	public function prepare_pizza( Pizza $pizza ) : int {
		$ingredients = $pizza->get_ingredients();
		$ingredients = array_map( fn( $ingredient ) => $ingredient->get_price(), $ingredients );
		$price       = ! empty( $ingredients ) ? max( $ingredients ) * 5 : 0;

		return $price;
	}
}