<?php

namespace Gturpin\TainixChallenges\Challenges\NOEL_2023_4;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/maman-jai-rate-lavion
 */
final class Noel_2023_4 extends Challenge {
	
	protected const USE_DATA_TEST = false;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		$steps  = $this->data['parcours'] ?? '';
		$steps  = str_split( $steps );
		$steps  = array_map( fn( $step ) => Direction::tryFrom( $step ), $steps );
		$steps  = array_filter( $steps );
		$traps  = $this->data['pieges'] ?? [];
		$traps  = array_map( fn( $trap ) => Trap::from_raw( $trap ), $traps );
		$garden = new Garden( new Grid( 10, 10 ), $traps );
		$thief  = new Thief( new Position( 0, 0 ) );
		$result = '';
	
		foreach ( $steps as $step ) {
			$thief->move( $step );

			// If the thief is on a trap, add the trap id to the result
			$current_traps = $garden->get_traps_at( $thief->get_position() );

			// Bail early if there is no trap at the current position
			if ( empty( $current_traps ) ) {
				continue;
			}

			// Sort traps by alphabetical order
			$current_traps = array_map( fn( $trap ) => $trap->get_id(), $current_traps );
			sort( $current_traps );

			$result .= implode( '', $current_traps );
		}
		
		return $result;
	}
}