<?php

namespace Gturpin\TainixChallenges\Challenges\RUGBY_2;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/Coupe-du-monde-de-rugby-Compter-les-points
 */
final class Rugby_2 extends Challenge {
	
	protected const USE_DATA_TEST = false;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		$actions = $this->data['actions'] ?? [];
		$actions = str_split( $actions );
		$actions = array_map( fn( $action ) => Action::from( $action ), $actions );

		$score = new Score();
		$score->filter_actions( $actions );

		return $score->get_total();
	}
}