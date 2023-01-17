<?php

namespace Gturpin\TainixChallenges\Challenges\STARTER_2;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/Variables-et-concatenation
 */
final class Starter_2 extends Challenge {
	
	protected const USE_DATA_TEST = false;
	protected const ENABLE_LOG    = false;
	
	public function solve() : mixed {
		$name = $this->data['name'] ?? null;
		$room = $this->data['room'] ?? null;

		$sentence = $name . ' is in the ' . $room . '.';

		return $sentence;
	}
}