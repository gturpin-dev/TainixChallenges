<?php

namespace Gturpin\TainixChallenges\Challenges\ELECTION;

use Gturpin\TainixChallenges\Challenge;
use Gturpin\TainixChallenges\Challenges\ELECTION\Counting;
use Gturpin\TainixChallenges\Challenges\ELECTION\Candidate;

/**
 * @link https://tainix.fr/challenge/Depouillement-des-bulletins-de-vote
 */
final class Election extends Challenge {
	
	protected const USE_DATA_TEST = false;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		$votes      = $this->data['votes'] ?? '';
		$votes      = str_split( $votes );
		$votes      = array_map( fn( $candidate ) => new Candidate( $candidate ), $votes );
		$candidates = $this->data['candidates'] ?? '';
		$candidates = str_split( $candidates );
		$candidates = array_map( fn( $candidate ) => new Candidate( $candidate ), $candidates );

		$couting = new Counting( $votes, $candidates );
		$couting->count();
		$result = $couting->display( 2 );

		return $result;
	}
}