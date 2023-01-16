<?php

namespace Gturpin\TainixChallenges\Challenges\FOOTBALL_3;

final class Match_Handler {

	private const WIN_POINTS  = 3;
	private const DRAW_POINTS = 1;

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
		[ $team1, $team2, $score1, $score2 ] = array_pad( explode( '_', $score ), 4, null );

		isset( $team1 ) ? $parsed_score[ $team1 ] = (int) $score1 : null;
		isset( $team2 ) ? $parsed_score[ $team2 ] = (int) $score2 : null;

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
			array_map( fn( $team ) => $this->teams[ $team ] += self::DRAW_POINTS, $winning_team );
		} else {
			$winning_team = $winning_team[ array_key_first( $winning_team ) ];
			$this->teams[ $winning_team ] += self::WIN_POINTS;
		}
	}

	/**
	 * return the rank of the teams sorted by points
	 *
	 * @return array
	 */
	public function get_ranks() : array {
		arsort( $this->teams );
		
		return $this->teams;
	}
}