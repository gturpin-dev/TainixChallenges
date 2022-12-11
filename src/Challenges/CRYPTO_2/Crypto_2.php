<?php

namespace Gturpin\TainixChallenges\Challenges\CRYPTO_2;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/Braquage-du-coffre
 */
final class Crypto_2 extends Challenge {
	
	public function solve() : mixed {
		$combinaison = $this->data['depart'] ?? 0;
		$path        = $this->data['chemin'] ?? [];

		foreach ( $path as $step ) {
			$step_sign = substr( $step, 0, 1 );
			$step_size = strlen( $step );
			$operation = 10 ** ( $step_size - 1 );

			switch ( $step_sign ) {
				case '+':
					$combinaison += $operation;
					continue 2;
				case '-':
					$combinaison -= $operation;
					continue 2;
			}
		}

		return $combinaison;
	}
}