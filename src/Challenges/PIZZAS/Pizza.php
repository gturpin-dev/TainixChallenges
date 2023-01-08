<?php

namespace Gturpin\TainixChallenges\Challenges\PIZZAS;

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
}