<?php

namespace Gturpin\TainixChallenges\Challenges\DIGITALART_1;

use Gturpin\TainixChallenges\Challenge;
use Illuminate\Support\Collection;

/**
 * @link https://tainix.fr/challenge/CTC-1-Le-grand-saut
 */
final class Digitalart_1 extends Challenge {
	
	protected const USE_DATA_TEST = false;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		$accounts = new Collection( $this->data['accounts'] ?? [] );

		$total_followers = $accounts->sum();

		return $total_followers;
	}
}