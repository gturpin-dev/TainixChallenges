<?php

namespace Gturpin\TainixChallenges\Challenges\DBZ_1;

use Gturpin\TainixChallenges\Challenge;
use Gturpin\TainixChallenges\Challenges\DBZ_1\Vegeta;

/**
 * @link https://tainix.fr/challenge/Vegeta-combat-ses-ennemis
 */
final class Dbz_1 extends Challenge {
	
	public function solve() : mixed {
		$opponents = $this->data['ennemis'] ?? 0;
		$strength  = $this->data['force_vegeta'] ?? 0;
		$vegeta    = new Vegeta( $strength );

		while ( ! empty( $opponents ) ) {
			$opponent = array_shift( $opponents );

			// Fight until the opponent is defeated
			while ( ! $vegeta->fight( $opponent ) );
		}

		return $vegeta->get_power();
	}
}