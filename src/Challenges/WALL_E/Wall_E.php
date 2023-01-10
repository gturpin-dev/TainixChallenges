<?php

namespace Gturpin\TainixChallenges\Challenges\WALL_E;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/WALL-E-1
 */
final class Wall_E extends Challenge {
	
	protected const USE_DATA_TEST = true;
	
	public function solve() : mixed {
		echo '<pre>' . print_r( $this->data, true ) . '</pre>';
		
		die;
	}
}