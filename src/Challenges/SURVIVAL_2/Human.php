<?php

namespace Gturpin\TainixChallenges\Challenges\SURVIVAL_2;

use Gturpin\TainixChallenges\Challenges\SURVIVAL_2\Survival_2;

final class Human {
	
	/**
	 * The basic needs of a human, if one of them is 0, the human is dead.
	 */
	private int $thirst;
	private int $hunger;
	private int $energy;
	
	public function __construct( array $data ) {
		$this->thirst = $data['thirst'] ?? 0;
		$this->hunger = $data['hunger'] ?? 0;
		$this->energy = $data['energy'] ?? 0;
	}

	/**
	 * Explore the island
	 *
	 * @param Island $island
	 *
	 * @return boolean
	 */
	public function explore_island( Island $island ) : bool {
		$successful = true;
		$regions    = $island->get_regions();

		foreach ( $regions as $region ) {
			$successful = $this->explore_region( $region );
			
			if ( ! $successful ) {
				break;
			}
		}

		return $successful;
	}

	/**
	 * Explore a region of the island
	 *
	 * @param string $region
	 *
	 * @return void
	 */
	public function explore_region( string $region ) {
		$steps = str_split( $region );

		foreach ( $steps as $step ) {
			match ( $step ) {
				'W'     => $this->thirst++,
				'F'     => $this->hunger++,
				'_'     => $this->energy -= 2,   // 2 + the energy of the step = 3
				default => null
			};

			// Exploring a step costs 1 energy
			$this->energy--;

			Survival_2::log( 'Thirst: ' . $this->thirst );
			Survival_2::log( 'Hunger: ' . $this->hunger );
			Survival_2::log( 'Energy: ' . $this->energy );
			Survival_2::log( '' );
			
			if ( $this->is_dead() ) {
				return false;
			}
		}

		// At the end of the region, it's the night, so the human needs to sleep
		$this->sleep();

		// The Human can die during the night if he is too hungry or thirsty
		if ( $this->is_dead() ) {
			return false;
		}
		
		return true;
	}

	/**
	 * The Human sleeps to recover energy
	 *
	 * @return void
	 */
	private function sleep() {
		$this->energy += ( $this->thirst + $this->hunger ) / 2;
		$this->thirst -= 5;
		$this->hunger -= 5;
	}

	/**
	 * Check if the human is dead
	 *
	 * @return boolean
	 */
	public function is_dead() : bool {
		return $this->thirst <= 0 || $this->hunger <= 0 || $this->energy <= 0;
	}

	public function get_thirst() : int {
		return $this->thirst;
	}

	public function get_hunger() : int {
		return $this->hunger;
	}

	public function get_energy() : int {
		return $this->energy;
	}
}