<?php

namespace Gturpin\TainixChallenges\Challenges\MONSTERS_2;

/**
 * Model a food for a monster
 */
final class Food {

	public function __construct(
		private readonly FoodType $type,
		private readonly int $weight,
	) {}
	
	/**
	 * Create a Food object from a coded value
	 * The coded value is a string of 2 characters
	 * The first character is the type of the food
	 * The second character is the weight of the food
	 *
	 * @param string $coded_value The coded value like "G8" for Grass of 8 weight
	 *
	 * @return self
	 */
	public static function from_coded_value( string $coded_value ): self {
		$type   = FoodType::tryFrom( $coded_value[ 0 ] ?? '' ) ?? null;
		$weight = (int) $coded_value[ 1 ] ?? 0;		

		return new self( $type, $weight );
	}

	public function get_type(): FoodType {
		return $this->type;
	}

	public function get_weight(): int {
		return $this->weight;
	}
}