<?php

namespace Gturpin\TainixChallenges\Challenges\RUGBY_1;

/**
 * This class is used to decode the stats of a player
 */
final class PlayerEncoder {

	private int $weight;
	private int $strength;

	/**
	 * The delimiter used to separate the weight and the strength
	 */
	private const DELIMITER = ':';

	/**
	 * Decode the stats and store them in the object
	 * 
	 * @param string $encoded_stats The encoded stats of the player format : "weight-strength"
	 */
	public function __construct( string $encoded_stats ) {
		$this->decode( $encoded_stats );
	}

	/**
	 * Decode the stats
	 * 
	 * @param string $encoded_stats The encoded stats of the player format : "weight-strength"
	 * 
	 * @throws \InvalidArgumentException If the encoded stats are not valid
	 * 
	 * @return void
	 */
	private function decode( string $encoded_stats ) : void {
		$stats = explode( self::DELIMITER, $encoded_stats );

		if ( count( $stats ) !== 2 ) {
			throw new \InvalidArgumentException( 'The encoded stats are not valid' );
		}

		$this->weight    = (int) $stats[0];
		$this->strength  = (int) $stats[1];
	}

	/**
	 * Getters & Setters
	 */

	public function get_weight() : int {
		return $this->weight;
	}

	public function get_strength() : int {
		return $this->strength;
	}
}