<?php

namespace Gturpin\TainixChallenges\Challenges\DBZ_1;

final class Vegeta {

	private int $strength;
	private int $level = 1;

	/**
	 * Level is always equal to $this->level * $this->strength
	 */
	private int $power;

	public function __construct( int $strength ) {
		$this->strength = $strength;
		$this->update_power();
	}
	
	/**
	 * Fight an opponent
	 * Vegeta's fight an opponent, he wins, he gains 10% of the opponent's power
	 * If he loses, he gain a level
	 *
	 * @param integer $opponent The opponent's power
	 *
	 * @return bool True if the opponent is defeated, false otherwise
	 */
	public function fight( int $opponent ) : bool {
		if ( $this->power >= $opponent ) {
			$this->set_strength( $this->strength + floor( $opponent * 0.1 ) );
			$this->update_power();
			
			return true;
		}

		$this->level++;
		$this->update_power();
		
		return false;
	}
	
	public function get_strength() : int {
		return $this->strength;
	}

	public function set_strength( int $strength ) : void {
		$this->strength = $strength;
		$this->update_power();
	}

	/**
	 * Update the power of the character based his stats
	 *
	 * @return void
	 */
	public function update_power() : void {
		$this->power = $this->strength * $this->level;
	}

	public function get_power() : int {
		return $this->power;
	}
}