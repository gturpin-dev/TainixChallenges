<?php

namespace Gturpin\TainixChallenges\Challenges\POKEMON_1;

use Gturpin\TainixChallenges\Challenge;
use Gturpin\TainixChallenges\Challenges\POKEMON_1\Pokemons;

/**
 * @link https://tainix.fr/challenge/Team-Pokemon
 */
final class Pokemon_1 extends Challenge {
	
	public function solve() : mixed {
		$types     = $this->data['types'] ?? [];
		$pokemons  = new Pokemons( $types );
		$max_teams = $pokemons->get_max_teams();

		return $max_teams;
	}
}