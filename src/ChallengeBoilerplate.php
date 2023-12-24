<?php

namespace Gturpin\TainixChallenges\Challenges\CHALLENGE_BOILERPLATE;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link TODO : add link to challenge here (https://tainix.fr/challenges/)
 */
final class Challenge_Boilerplate extends Challenge {
	protected const USE_DATA_TEST = true;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		dump( $this->data );
		
		die;
	}
}