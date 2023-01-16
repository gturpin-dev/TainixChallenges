<?php

namespace Gturpin\TainixChallenges\Challenges\DBZ_3;

use Gturpin\TainixChallenges\Challenges\DBZ_3\Dbz_3;

final class Sayan {

	/**
	 * The strength of the sayan
	 */
	private int $strength;

	/**
	 * The HP
	 */
	private int $hp;

	/**
	 * The super attack damage
	 */
	private int $super;

	/**
	 * If the sayan is paralysed
	 */
	private bool $is_paralysed = false;

	/**
	 * The counter to trigger a special attack
	 */
	private int $special_attack_counter = 1000;

	/**
	 * The counter of special attack done
	 */
	private int $count_special_attack_done = 0;
	
	public function __construct( array $stats ) {
		$this->strength = $stats['strength'] ?? 0;
		$this->hp       = $stats['hp'] ?? 0;
		$this->super    = $stats['super'] ?? '';
	}

	/**
	 * Attack an opponent with basic attack
	 * 
	 * @param Sayan $opponent The opponent
	 * 
	 * @return void
	 */
	public function attack( Sayan $opponent ) {
		// If the sayan is paralysed, he cannot attack
		if ( $this->is_paralysed() ) {
			$this->update_status();
			return;
		}

		// If a special attack is triggered, do not attack aswell
		if ( $this->maybe_special_attack( $opponent ) ) {
			return;
		}

		// Attack the opponent
		$opponent->get_damage( $this->strength );
	}

	/**
	 * Maybe attack an opponent with super attack
	 * Need to be alive and not paralysed
	 * Set the opponent paralysed
	 *
	 * @param Sayan $opponent
	 *
	 * @return bool True if a special attack is triggered, false otherwise
	 */
	public function maybe_special_attack( Sayan $opponent ) : bool {
		if ( $this->is_paralysed() ) {
			return false;
		}

		if ( $this->special_attack_counter <= 0 ) {
			$this->special_attack( $opponent );
			return true;
		}

		return false;
	}

	/**
	 * Do a special attack
	 *
	 * @param Sayan $opponent
	 *
	 * @return void
	 */
	public function special_attack( Sayan $opponent ) {
		Dbz_3::log( 'Special attack' );
		$opponent->get_damage( $this->super, true );
		$opponent->set_paralysed( true );
		
		$this->reset_special_attack_counter();
		$this->count_special_attack_done++;

	}

	/**
	 * Update the status of the sayan
	 */
	public function update_status() {
		if ( $this->is_paralysed() ) {
			$this->set_paralysed( false );
		}
	}

	/**
	 * Count the special attack done
	 *
	 * @return int The number of special attack done
	 */
	public function count_special_attack_done() : int {
		return $this->count_special_attack_done;
	}

	/**
	 * Get damage from an opponent
	 *
	 * @param integer $damage The damage number
	 * @param boolean $is_special_attack If the damage is from a special attack
	 *
	 * @return void
	 */
	public function get_damage( int $damage, bool $is_special_attack = false ) {
		$this->hp -= $damage;

		if ( ! $is_special_attack ) {
			$this->special_attack_counter -= $damage;
		}
	}

	public function reset_special_attack_counter() {
		$this->special_attack_counter = 1000;
	}

	public function is_dead() : bool {
		return $this->hp <= 0;
	}

	public function is_paralysed() : bool {
		return $this->is_paralysed === true;
	}

	public function set_paralysed( bool $paralysed ) {
		$this->is_paralysed = $paralysed;
	}

	public function get_hp() : int {
		return $this->hp;
	}
}