<?php

namespace Gturpin\TainixChallenges\Challenges\DIGITALART_1;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link TODO : add link to challenge here (https://tainix.fr/challenges/)
 */
final class Digitalart_1 extends Challenge {
	
	protected const USE_DATA_TEST = false;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		$accounts = $this->data['accounts'] ?? [];

		$total_followers = array_reduce( $accounts, fn( $total, $account ) => $total + $account, 0 );

		return $total_followers;
	}
}