<?php

namespace Gturpin\TainixChallenges\Challenges\MARIO_1;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/entrainement-de-Peach-et-Mario
 */
final class Mario_1 extends Challenge {
	
	protected const USE_DATA_TEST = false;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		$platforms            = $this->data['platforms'];
		$platforms            = explode( 'P', $platforms );
		$platforms            = array_map( fn( $platform ) => strlen( $platform ), $platforms );
		$who_jumped           = [];
		$last_who_jumped_on_3 = null;

		// Determine for each platform who jump on it
		foreach ( $platforms as $platform ) {
			switch ( $platform ) {
				case 1:
				case 2:
					$who_jump = 'M';
					break;
				case 3:
					$who_jump             = ( is_null( $last_who_jumped_on_3 ) || $last_who_jumped_on_3 === 'M' ) ? 'P' : 'M';
					$last_who_jumped_on_3 = $who_jump;
					break;
				case 4:
				case 5:
					$who_jump = 'P';
					break;
				default:
					$who_jump = ''; // nobody
					break;
			}

			self::log( "Platform length: $platform, who jump: $who_jump" );

			$who_jumped[] = $who_jump;
		}
		
		$result = implode( '', $who_jumped );

		return $result;
	}
}