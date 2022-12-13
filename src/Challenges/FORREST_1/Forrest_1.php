<?php

namespace Gturpin\TainixChallenges\Challenges\FORREST_1;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/Cours-Forrest-Cours
 */
final class Forrest_1 extends Challenge {
	
	public function solve() : mixed {
		$bornes               = $this->data['kms'] ?? [];
		$runners              = $this->data['runners'] ?? [];
		$stop                 = $this->data['stop'] ?? 0;
		$score                = $stop ?: 0;
		$runners_with_forrest = 0;

		foreach ( $bornes as $i => $current_borne ) {
			$runners_with_forrest += $runners[ $i ] ?? 0;
			$next_borne           = $bornes[ $i + 1 ] ?? $stop;
			$km_to_next_borne	  = $next_borne - $current_borne;

			$score += $km_to_next_borne * $runners_with_forrest;
		}

		return $score;
	}
}