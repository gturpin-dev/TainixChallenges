<?php

namespace Gturpin\TainixChallenges\Challenges\PIZZAS;

use Gturpin\TainixChallenges\Challenge;
use Gturpin\TainixChallenges\Challenges\PIZZAS\Order;
use Gturpin\TainixChallenges\Challenges\PIZZAS\Pizza;
use Gturpin\TainixChallenges\Challenges\PIZZAS\Ingredients;
use Gturpin\TainixChallenges\Challenges\PIZZAS\PizzaioloFactory;

/**
 * @link https://tainix.fr/challenge/YOLO-les-Pizzaiolos
 */
final class Pizzas extends Challenge {
	
	public function solve() : mixed {
		$ingredients        = $this->data['ingredients'];
		$pizzas_ingredients = $this->data['pizzas'];
		$pizzaiolos         = $this->data['pizzaiolos'];
		$total_price        = 0;

		Ingredients::init( $ingredients );
		$order = new Order();

		foreach ( $pizzas_ingredients as $index => $pizza_ingredients ) {
			$pizza = Pizza::create_from_ingredient_list( $pizza_ingredients );

			// Get the right pizzaiolo for this pizza
			$pizzaiolo = PizzaioloFactory::create_from_index( $index, $pizzaiolos );
			$price = $order->order( $pizza, $pizzaiolo );

			self::log( $pizzaiolo->get_name() . ' : ' . $price );
		}

		$total_price = $order->get_addition();
		self::log( 'Total : ' . $total_price );

		return $total_price;
	}
}