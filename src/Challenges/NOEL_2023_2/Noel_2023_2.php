<?php

namespace Gturpin\TainixChallenges\Challenges\NOEL_2023_2;

use Gturpin\TainixChallenges\Challenge;
use Gturpin\TainixChallenges\Challenges\NOEL_2023_2\Kid;
use Gturpin\TainixChallenges\Challenges\NOEL_2023_2\Grinch;

/**
 * @link https://tainix.fr/challenge/le-grinch
 */
final class Noel_2023_2 extends Challenge {
	
	protected const USE_DATA_TEST = false;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		$fear_factor  = $this->data['fear'] ?? 0;
		$time_left    = $this->data['time'] ?? 0;
		$grinch       = new Grinch( $fear_factor, $time_left );
		$kids_to_fear = $this->data['kids'] ?? [];
		$kids_to_fear = array_map( fn ( $kid ) => Kid::from_raw( $kid ), $kids_to_fear );
		$scared_kids  = [];

		while ( ! empty( $kids_to_fear ) ) {
			if ( $grinch->get_time_left() < $grinch::TIME_TO_FEAR ) {
				break;
			}
			
			$kid_to_fear = array_shift( $kids_to_fear );
			$has_scared  = $grinch->try_fear( $kid_to_fear );

			if ( $has_scared ) {
				$scared_kids[] = $kid_to_fear;
			}
		}
		
		if ( empty( $scared_kids ) ) {
			return 'GRINCH';
		}

		$result = array_reduce( $scared_kids, function( $result, $kid ) {
			return $result . strtoupper( $kid->get_first_letter() );
		}, '' );

		return $result;
	}
}