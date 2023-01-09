<?php

namespace Gturpin\TainixChallenges\Challenges\PIZZAS;

use Gturpin\TainixChallenges\Challenges\PIZZAS\Pizza;
use Gturpin\TainixChallenges\Challenges\PIZZAS\Pizzaiolo;

final class Order {

	/**
	 * @var array<Pizza>
	 */
	private array $pizzas = [];

	private int $addition = 0;

	/**
	 * Order a pizza
	 *
	 * @param Pizza $pizza The pizza to order
	 * @param Pizzaiolo $pizzaiolo The pizzaiolo who will prepare the pizza
	 *
	 * @return int The price of the pizza
	 */
	public function order( Pizza $pizza, Pizzaiolo $pizzaiolo ) : int {
		$price = $pizzaiolo->prepare_pizza( $pizza );
		
		$this->addition += $price;
		$this->pizzas[] = $pizza;

		return $price;
	}

	public function get_addition() : int {
		return $this->addition;
	}
}