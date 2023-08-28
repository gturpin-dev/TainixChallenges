<?php

namespace Gturpin\TainixChallenges\Challenges\ELECTION;

final class Counting {

	/**
	 * The votes counted for each candidate
	 *
	 * @var array<string, int>
	 */
	private array $votes_count = [];

	/**
	 * Precision of the percentage ( number of decimals after comma )
	 */
	private const PERCENTAGE_PRECISION = 1;

	/**
	 * Separator used to display the result
	 */
	private const DISPLAY_SEPARATOR = '-';

	public function __construct(
		/**
		 * Array of Votes for a Candidate
		 *
		 * @var array<Candidate>
		 */
		private array $votes,

		/**
		 * Array of Candidates who are in the election
		 * 
		 * @var array<Candidate>
		 */
		private array $candidates
	) {
		$this->candidates = array_filter( $this->candidates, fn( $candidate ) => $candidate instanceof Candidate );
		$this->votes      = array_filter( $this->votes, fn( $vote ) => $vote instanceof Candidate );
		$this->votes      = array_filter( $this->votes, fn( $vote ) => in_array( $vote, $this->candidates ) );
	}

	/**
	 * Count the votes for each candidate
	 * If a candidate is not in the $candidates array, he is not counted
	 *
	 * @return void
	 */
	public function count(): void {
		// Count occurences of each candidate in votes
		$votes = array_map( fn( $vote ) => $vote->get_name(), $this->votes );
		$votes = array_count_values( $votes );

		$this->votes_count = $votes;
	}

	/**
	 * Display the candidates with the most votes
	 *
	 * @param integer $candidate_to_show Number of candidates to show
	 *
	 * @return string The candidates with the most votes
	 */
	public function display( int $candidate_to_show ): string {
		$total_votes = count( $this->votes );
		$percentages = $this->votes_count;
		$percentages = array_map( fn( $vote ) => round( $vote / $total_votes * 100, self::PERCENTAGE_PRECISION ), $percentages );
		arsort( $percentages );
		$percentages = array_slice( $percentages, 0, $candidate_to_show, true );

		// Prepare the display
		$display = array_map( fn( $percentage, $candidate ) => $candidate . $percentage, $percentages, array_keys( $percentages ) );
		$display = implode( self::DISPLAY_SEPARATOR, $display );

		return $display;
	}
}