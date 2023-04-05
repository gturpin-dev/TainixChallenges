<?php

namespace Gturpin\TainixChallenges\Challenges\DIGITALART_4;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link TODO : add link to challenge here (https://tainix.fr/challenges/)
 */
final class Digitalart_4 extends Challenge {
	
	protected const USE_DATA_TEST = true;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		echo '<pre>' . print_r( $this->data, true ) . '</pre>';
		
		die;
	}
}