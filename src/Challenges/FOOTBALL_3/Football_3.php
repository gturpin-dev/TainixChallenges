<?php

namespace Gturpin\TainixChallenges\Challenges\FOOTBALL_3;

use Gturpin\TainixChallenges\Challenge;
use Gturpin\TainixChallenges\Challenges\FOOTBALL_3\Match_Handler;

/**
 * @link https://tainix.fr/challenge/Euro-2020-en-2021
 */
final class Football_3 extends Challenge {

	public function solve() : mixed {
		$teams         = $this->data['group'] ?? [];
		$scores        = $this->data['scores'] ?? [];
		$match_handler = new Match_Handler( $teams );

		foreach ( $scores as $score ) {
			$score = $match_handler->parse_score( $score );
			$match_handler->add_score( $score );
		}

		return implode( '', array_keys( $match_handler->get_ranks() ) );
	}
}