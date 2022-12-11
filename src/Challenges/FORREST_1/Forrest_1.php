<?php

namespace Gturpin\TainixChallenges\Challenges\FORREST_1;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/Cours-Forrest-Cours
 */
final class Forrest_1 extends Challenge {
	
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