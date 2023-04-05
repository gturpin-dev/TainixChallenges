<?php

namespace Gturpin\TainixChallenges\Challenges\DIGITALART_5;

use Illuminate\Support\Collection;
use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/CTC-5-Il-nie-en-bloc
 */
final class Digitalart_5 extends Challenge {
	
	protected const USE_DATA_TEST = true;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		echo '<pre>' . print_r( $this->data, true ) . '</pre>';
		
		$blocks = new Collection( $this->data['blocks'] ?? [] );
		
		die;
	}
}