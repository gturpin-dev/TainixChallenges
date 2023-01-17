<?php

namespace Gturpin\TainixChallenges\Challenges\STARTER_1;

use Gturpin\TainixChallenges\Challenge;
use Gturpin\TainixChallenges\Challenges\STARTER_1\Square;

/**
 * @link https://tainix.fr/challenge/Variables-et-calculs
 */
final class Starter_1 extends Challenge {
	
	protected const USE_DATA_TEST = true;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		$side = $this->data['side'] ?? 0;

		$square = new Square( $side );

		$square_area      = $square->get_area();
		$square_perimeter = $square->get_perimeter();

		return $square_area + $square_perimeter;
	}
}