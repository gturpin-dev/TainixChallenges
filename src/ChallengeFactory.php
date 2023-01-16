<?php

namespace Gturpin\TainixChallenges;

use Gturpin\TainixChallenges\Game;
use Gturpin\TainixChallenges\Challenge;

/**
 * Class to solve dynamically a challenge from the challenge code
 */
final class ChallengeFactory {
	
	private const API_KEY = '5c8dceafcb519e473a8f3b62e6f7303868e69f9a';
	
	/**
	 * Solve a challenge from the challenge code
	 * Check that the challenge class exists and extends Challenge class
	 *
	 * @param string $challenge_code The challenge code like 'POKEMON_1'
	 *
	 * @return void
	 */
	public function solve( string $challenge_code ) {
		$game = new Game( self::API_KEY, $challenge_code );
		$data = $game->input();

		// Make the challenge class name from the challenge code like 'POKEMON_1' => 'Pokemon_1'
		$challenge_classname = str_replace( ' ', '_', ucwords( str_replace( '_', ' ', strtolower( $challenge_code ) ) ) );
		$challenge_classname = __NAMESPACE__ . '\\Challenges\\' . $challenge_code . '\\' . $challenge_classname;

		// Check if the challenge class exists
		if ( ! class_exists( $challenge_classname ) ) {
			throw new \Exception( 'The Challenge class "' . $challenge_classname . '" not found' );
		}

		// Class must extends Challenge
		if ( ! is_subclass_of( $challenge_classname, Challenge::class ) ) {
			throw new \Exception( 'The Challenge class "' . $challenge_classname . '" must extends Challenge' );
		}

		// Solve the challenge and get the response
		$challenge = new $challenge_classname( $challenge_code, $data );
		$response  = $challenge->solve();

		// Answer to the challenge via API
		$game->output( [ 'data' => $response ] );
	}
}