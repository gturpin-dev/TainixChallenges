<?php

namespace Gturpin\TainixChallenges\Challenges\NOEL_2023_3;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/die-hard
 */
final class Noel_2023_3 extends Challenge {
	
	protected const USE_DATA_TEST = false;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		$john_position      = $this->data['john'];
		$opponents_position = $this->data['ennemis'];
		$max_stage          = 100;
		$stages_clear       = [ $john_position, $max_stage ];
		
		// Add all opponents position in the stages
		$stages       = array_fill( 1, $max_stage, 0 );
		$count_values = array_count_values( $opponents_position );
		$stages       = array_replace( $stages, $count_values );

		// While john has not reached the last stage
		while ( $john_position <= $max_stage ) {
			// If no opponents in this stage, continue
			if ( $stages[ $john_position ] === 0 ) {
				$john_position++;
				continue;
			}

			// If opponents, fight them
			$stages_clear[]           = $john_position;
			$stages[ $john_position ] = 0;

			// The noise of the fight make the opponents from 3 stages above move down from 1 stage
			for ( $i = 1; $i <= 3; $i++ ) {
				$opponents = $stages[ $john_position + $i ];
				$stages[ $john_position + $i ] = 0;

				// Add the opponents to the stage below
				$stages[ $john_position + $i - 1 ] += $opponents;
			}

			// if opponents down to the current stage, second fight start
			if ( $stages[ $john_position ] !== 0 ) {
				continue;
			}

			// Go to the next stage
			$john_position++;
		}

		sort( $stages_clear );
		$result = implode( '-', $stages_clear );

		return $result;
	}
}