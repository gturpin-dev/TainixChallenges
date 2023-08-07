<?php

namespace Gturpin\TainixChallenges\Challenges\CRYPTO_1;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/Break-the-code-1
 */
final class Crypto_1 extends Challenge {
	
	protected const USE_DATA_TEST = true;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		echo '<pre>' . print_r( $this->data, true ) . '</pre>';
		
		die;
	}
}