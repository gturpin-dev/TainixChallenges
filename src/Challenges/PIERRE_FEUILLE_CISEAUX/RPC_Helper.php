<?php

namespace Gturpin\TainixChallenges\Challenges\PIERRE_FEUILLE_CISEAUX;

/**
 * Helper class for Rock Paper Scissors game
 */
class RPC_Helper {

	private const ROCK     = 'P';
	private const PAPER    = 'F';
	private const SCISSORS = 'C';
	
	/**
	 * Return the choice to win against the opponent choice
	 *
	 * @param string $opponent_choice The opponent choice
	 *
	 * @return ?string The choice to win
	 */
	public function get_choice_to_win( string $opponent_choice ) : ?string {
		return match ( $opponent_choice ) {
			self::ROCK     => self::PAPER,
			self::PAPER    => self::SCISSORS,
			self::SCISSORS => self::ROCK,
			default 	   => null,
		};
	}
}