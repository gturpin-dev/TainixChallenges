<?php

namespace Gturpin\TainixChallenges\Challenges\FOOTBALL_3;

final class Match_Handler {

	private array $teams = [];
	
	public function __construct( array $teams ) {
		foreach ( $teams as $team ) {
			$this->teams[ $team ] = 0;
		}
	}

	/**
	 * Parse a score string into an array of scores
	 *
	 * @param string $score Score string to parse, format : 'team1_team2_score1_score2'
	 *
	 * @return array
	 */
	public function parse_score( string $score ) : array {
		[ $team1, $team2, $score1, $score2 ] = array_pad( explode( '_', $score ), 4, '_' );

		$parsed_score = [
			$team1 => (int) $score1,
			$team2 => (int) $score2
		];
		
		foreach ( $parsed_score as $team => $score ) {
			if ( ! in_array( $team, array_keys( $this->teams ) ) ) {
				throw new \Exception( 'Invalid team name' );
			}
		}

		return $parsed_score;
	}

	/**
	 * Add a score to the teams points
	 *
	 * @param array $score Score previously parsed with parse_score() method
	 *
	 * @return void
	 */
	public function add_score( array $score ) {
		if ( count( $score ) !== 2 ) {
			throw new \Exception( 'Invalid score' );
		}

		// Get the key team with the highest score
		$winning_team = array_keys( $score, max( $score ) );

		// If there is more than one team with the highest score, it's a draw => add 1 point to each team
		if ( count( $winning_team ) > 1 ) {
			foreach ( $winning_team as $team ) {
				$this->teams[ $team ] += 1;
			}
		} else {
			$this->teams[ $winning_team ] += 3;
		}

		echo '<pre>' . print_r( $score, true ) . '</pre>';
		var_dump( $winning_team );
		die;
	}

	/**
	 * return the rank of the teams sorted by points
	 *
	 * @return array
	 */
	public function get_ranks() : array {
		asort( $this->teams );
		
		return $this->teams;
	}
}