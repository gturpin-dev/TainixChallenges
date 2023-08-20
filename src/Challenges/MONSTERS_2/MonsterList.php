<?php

namespace Gturpin\TainixChallenges\Challenges\MONSTERS_2;

/**
 * Model a list of monsters
 */
final class MonsterList {
	
	public function __construct(
		private array $monsters,
	) {
		// Map monsters with their name in key and their object in value
		$this->monsters = array_reduce( $monsters, function( $carry, $monster ) {
			// Bail if the monster is not a Monster object
			if ( ! $monster instanceof Monster ) return $carry;
			
			$carry[ $monster->get_name() ] = $monster;
			return $carry;
		}, [] );
	}

	/**
	 * Find the lightest monster
	 * 
	 * @param FoodType $food_type The type of food that the monster must be able to eat
	 *
	 * @return Monster
	 */
	public function get_the_lightest_who_can_eat( FoodType $food_type ): Monster {
		$monsters = array_filter( $this->monsters, fn( $monster ) => $monster->can_eat( $food_type ) );

		// Sort the array of monster by their weight, the first one is the lightest
		usort( $monsters, [ self::class, 'sort_monsters_by_lightest' ] );

		return array_shift( $monsters );
	}

	/**
	 * Get the heaviest monster
	 *
	 * @return Monster
	 */
	public function get_the_heaviest(): Monster {
		$monsters = $this->monsters;

		// Sort the array of monster by their weight, the last one is the heaviest
		usort( $monsters, [ self::class, 'sort_monsters_by_lightest' ] );

		return array_pop( $monsters );
	}

	/**
	 * Sort monsters by their weight, the lightest is the first
	 *
	 * @param Monster $a The first monster to compare
	 * @param Monster $b The second monster to compare
	 *
	 * @return int
	 */
	private static function sort_monsters_by_lightest( Monster $a, Monster $b ): int {
		// Sort by weight
		if ( $a->get_weight() !== $b->get_weight() ) {
			return $a->get_weight() <=> $b->get_weight();
		}

		// Sort by name
		return $a->get_name() <=> $b->get_name();
	}

	public function add_monster( Monster $monster ): void {
		$this->monsters[] = $monster;
	}

	public function get_monster( string $monster_name ): Monster {
		$monsters = array_filter( $this->monsters, fn( $monster ) => $monster->get_name() === $monster_name );

		return array_shift( $monsters );
	}
	
	public function get_monsters(): array {
		return $this->monsters;
	}

	/**
	 * Update the monster by replacing it with the updated one
	 *
	 * @param Monster $updated_monster The updated monster
	 *
	 * @return bool True if the monster has been updated, false otherwise
	 */
	public function update_monster( Monster $updated_monster ): bool {
		$monsters     = $this->monsters;
		$monster_name = $updated_monster->get_name();

		// Bail if the monster does not exist
		if ( ! isset( $monsters[ $monster_name ] ) ) return false;
		
		$monsters[ $monster_name ] = $updated_monster;

		$this->monsters = $monsters;
		return true;
	}
}