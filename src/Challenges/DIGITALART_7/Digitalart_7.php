<?php

namespace Gturpin\TainixChallenges\Challenges\DIGITALART_7;

use Illuminate\Support\Collection;
use Gturpin\TainixChallenges\Challenge;

/**
 * @link TODO : add link to challenge here (https://tainix.fr/challenges/)
 */
final class Digitalart_7 extends Challenge {
	
	protected const USE_DATA_TEST = false;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		$track         = $this->data['track'] ?? [];
		$track         = new Collection( explode( '_', $track ) );
		$delay         = $this->data['delay'] ?? 0;                 // delay in seconds
		$delta_time    = $delay;                                    // delta time in seconds
		$total_time    = 0;
		$portion_catch = '';

		$jeff_is_catch = false;
		$track->each( function( $part ) use ( &$delta_time, &$jeff_is_catch, &$total_time, &$portion_catch ) {
			if ( $jeff_is_catch ) return;

			$portion_type = substr( $part, 0, 1 );
			$length       = substr( $part, 1 );
			$jeff_time    = (int) $length; // in seconds

			// use match to check the portion type and get the own_time
			// if the portion type is 'R' then reduce the length by 10%
			// if the portion type is 'T' then reduce the length by 5 seconds
			// if the portion type is 'C' then reduce the length by 10 seconds
			// if the portion type is 'S' then reduce the length by 50%
			// if the portion type is 'O' then reduce the length by 100%
			// All percentage are rounded to the top
			// the own_time cannot be negative
			$own_time = match ( $portion_type ) {
				'R'     => $length - floor( $length * 0.1 ),
				'T'     => $length - 5,
				'C'     => $length - 10,
				'S'     => $length - floor( $length * 0.5 ),
				'O'     => 0,
				default => $length,
			};
			$own_time = max( (int) $own_time, 0 );

			// decrease the delta time by the jeff_time minus the own_time
			$delta_time -= $jeff_time - $own_time;

			// add the own_time to the total_time
			$total_time += $own_time;

			if ( $delta_time < 0 ) {
				$jeff_is_catch = true;
				$portion_catch = $part;
			}
		} );

		$response = $portion_catch . ':' . $total_time;

		return $response;
	}
}