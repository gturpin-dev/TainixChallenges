<?php

namespace Gturpin\TainixChallenges\Challenges\POKEMON_1;

final class Pokemons {

	private const RARE_TYPES = [ 'Air', 'Poison', 'Glace', 'Psychique', 'Insecte' ];
	private const BASE_TYPES = [ 'Eau', 'Feu', 'Herbe' ];

	private array $types;
	private array $types_count;

	public function __construct( array $types ) {
		$this->types       = $types;
		$this->types_count = array_count_values( $types );
	}

	/**
	 * Comparison function to return the number of pokemons of each type.
	 *
	 * @param string $type The type of pokemon.
	 *
	 * @return int The number of pokemons of the given type.
	 */
	private function types_count( string $type ) {
		return $this->types_count[ $type ] ?? 0;
	}
	
	/**
	 * Return the number of teams of pokemon that can be created.
	 * A team is constituted of 4 pokemons, 3 of each base types and 1 of any rare types.
	 *
	 * @return int The number of teams of pokemon that can be created.
	 */
	public function get_max_teams() {
		$classic_types_count = array_map( [ $this, 'types_count' ], self::BASE_TYPES );
		$rare_types_count    = [ array_sum( array_map( [ $this, 'types_count' ], self::RARE_TYPES ) ) ];

		return min( array_merge( $classic_types_count, $rare_types_count ) );
	}
}