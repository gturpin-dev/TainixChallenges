<?php

namespace Gturpin\TainixChallenges\Challenges\MONSTERS_2;

/**
 * Model a monster
 */
final class Monster {
	
	/**
	 * The "a" of the formula to calculate the weight of the monster
	 */
	private int $a;

	/**
	 * The "b" of the formula to calculate the weight of the monster
	 */
	private int $b;

	/**
	 * The type of food that can be eaten by the monster
	 */
	private FoodType $food;
	
	public function __construct(
		private readonly string $name,
		private int $weight,
		string $formula
	) {
		$this->decode_formula( $formula );
	}

	/**
	 * Check if the monster can eat a food
	 *
	 * @param FoodType $food_type The type of food to check
	 *
	 * @return boolean True if the monster can eat the food, false otherwise
	 */
	public function can_eat( FoodType $food_type ): bool {
		return $this->food === $food_type;
	}

	/**
	 * Decode the formula and store datas in the monster
	 * The formula is a string of 3 characters,
	 * 		- the first one is the "a" of the formula to calculate the weight of the monster
	 * 		- the second one is the type of food that can be eaten by the monster
	 * 		- the third one is the "b" of the formula to calculate the weight of the monster
	 *
	 * @param string $formula The formula to decode
	 * 
	 * @throws \InvalidArgumentException If the formula is not valid
	 *
	 * @return void
	 */
	private function decode_formula( string $formula ): void {
		// Bail if the formula is not composed by 3 characters
		if ( strlen( $formula ) !== 3 ) {
			throw new \InvalidArgumentException( sprintf( 'The formula must be composed by 3 characters, %s given', strlen( $formula ) ) );
		}

		// Destructure the formula
		[ $a, $food_type, $b ] = str_split( $formula );

		// Bail if the food type is not valid
		$food_types = array_column( FoodType::cases(), 'value' );
		if ( ! in_array( $food_type, $food_types ) ) {
			throw new \InvalidArgumentException( sprintf( 'The food type must be one of "%s", %s given', implode( ', ', $food_types ), $food_type ) );
		}

		// Bail if the "a" is not a number
		if ( ! is_numeric( $a ) ) {
			throw new \InvalidArgumentException( sprintf( 'The "a" must be a number, %s given', $a ) );
		}

		// Bail if the "b" is not a number
		if ( ! is_numeric( $b ) ) {
			throw new \InvalidArgumentException( sprintf( 'The "b" must be a number, %s given', $b ) );
		}

		// Store the formula
		$this->a       = (int) $a;
		$this->b       = (int) $b;
		$this->food    = FoodType::from( $food_type );
	}
	
	/**
	 * Eat a food, and increase the weight of the monster if the food is the same as the one the monster can eat
	 *
	 * @param Food $food The food to eat
	 *
	 * @return void
	 */
	public function eat( Food $food ): void {
		// Bail if the monster cannot eat that food
		if ( $food->get_type() !== $this->food ) return;

		// Increase the weight of the monster
		$this->weight += ( $this->a * $food->get_weight() ) + $this->b;
	}
	
	public function get_weight(): int {
		return $this->weight;
	}

	public function get_name(): string {
		return $this->name;
	}
}