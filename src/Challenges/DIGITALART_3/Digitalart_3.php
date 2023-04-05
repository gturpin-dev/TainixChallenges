<?php

namespace Gturpin\TainixChallenges\Challenges\DIGITALART_3;

use Illuminate\Support\Collection;
use Gturpin\TainixChallenges\Challenge;

/**
 * @link TODO : add link to challenge here (https://tainix.fr/challenges/)
 */
final class Digitalart_3 extends Challenge {
	
	protected const USE_DATA_TEST = false;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		$pseudo              = $this->data['pseudo'] ?? '';
		$pseudo_weight       = 0;
		$list                = new Collection( $this->data['list'] ?? [] );
		$weight_list         = new Collection();

		// make a new list with the name in key with empty space replaced by _ and the value is the weight of the name
		$list->each( function( $item ) use ( $weight_list ) {
			$name        = $item;
			$name_weight = $this->get_weight_for_pseudo( $name );
			$weight_list->put( $name, $name_weight );
		} );

		// pick the name with the exact same weight as the pseudo
		$pseudo_weight = $this->get_weight_for_pseudo( $pseudo );
		$response      = $weight_list->search( $pseudo_weight );

		return $response;
	}

	private function get_weight_for_pseudo( string $pseudo ): int {
		$weight_for_alphabet = $this->get_weight_for_alphabet();
		$letters             = new Collection( str_split( $pseudo ) );
		$letters             = $letters->map( function( $letter ) use ( $weight_for_alphabet ) {
			return $weight_for_alphabet[ $letter ] ?? 0;
		} );

		return $letters->sum();
	}

	private function get_weight_for_alphabet(): array {
		// foreach letter in the common letters array find the position of the letter in alphabet
		$lowercase_alphabet = range( 'a', 'z' );
		$lowercase_alphabet = array_flip( $lowercase_alphabet );
		
		// increment every letter position by 1
		$lowercase_alphabet = array_map( fn( $item ) => $item + 1, $lowercase_alphabet );

		// Make the uppercase alphabet
		$uppercase_alphabet = [];
		$offset             = count( $lowercase_alphabet );
		array_walk( $lowercase_alphabet, function( $priority, $letter ) use ( &$uppercase_alphabet, $offset ) {
			$uppercase_alphabet[ strtoupper( $letter ) ] = $priority + $offset;
		} );

		// Merge the two alphabets
		return array_merge( $lowercase_alphabet, $uppercase_alphabet );
	}
}