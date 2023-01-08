<?php

namespace Gturpin\TainixChallenges\Challenges\PIZZAS\Pizzaiolos;

use Gturpin\TainixChallenges\Challenges\PIZZAS\Pizza;
use Gturpin\TainixChallenges\Challenges\PIZZAS\Pizzaiolo;

final class Leonardo extends Pizzaiolo {

	/**
	 * Only sum the price of the ingredients
	 *
	 * @param Pizza $pizza
	 *
	 * @return integer
	 */
	public function prepare_pizza( Pizza $pizza ) : int {
		$ingredients = $pizza->get_ingredients();
		$price       = 0;

		foreach ( $ingredients as $ingredient ) {
			$price += $ingredient->get_price();
		}

		return $price;
	}
}