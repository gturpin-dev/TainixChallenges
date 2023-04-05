<?php

namespace Gturpin\TainixChallenges\Challenges\DIGITALART_6;

use Illuminate\Support\Collection;
use Gturpin\TainixChallenges\Challenge;

/**
 * @link TODO : add link to challenge here (https://tainix.fr/challenges/)
 */
final class Digitalart_6 extends Challenge {
	
	protected const USE_DATA_TEST = false;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		$arts   = new Collection( $this->data['arts'] ?? [] );
		$base   = $this->data['base'] ?? 0;
		$length = 10;

		// for each art, apply the following rules
		// Transform each letter to its corresponding ascii code
		// transform each ascii code to its binary representation
		// Concat all the binary representation
		// transform the binary representation to the $base given
		// cut the binary representation to the $length given
		$arts = $arts->map( function( $art ) use ( $base, $length ) {
			$art = str_split( $art );
			$art = array_map( 'ord', $art );
			$art = array_map( 'decbin', $art );
			$art = implode( '', $art );
			$art = base_convert( $art, 2, $base );
			$art = substr( $art, 0, $length );

			return $art;
		} );

		$response = $arts->implode( '_' );

		return $response;
	}
}