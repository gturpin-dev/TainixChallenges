<?php

namespace Gturpin\TainixChallenges;

/**
 * Class to solve a challenge from the API
 * For each Challenge you need to create a new class that extends this one in challenges/CHALLENGE_CODE/ChallengeName_Code.php
 * Code the solve() method to solve the challenge
 */
abstract class Challenge {

	/**
	 * The challenge code like 'POKEMON_1'
	 */
	protected string $challenge_code;

	/**
	 * The challenge DATA
	 */
	protected array $data;

	public function __construct( string $challenge_code, array $data ) {
		$this->challenge_code = $challenge_code;
		$this->data           = $data;
	}

	/**
	 * Solve the challenge
	 *
	 * @return mixed The response to the challenge
	 */
	abstract public function solve() : mixed;
}