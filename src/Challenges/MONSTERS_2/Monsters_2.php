<?php

namespace Gturpin\TainixChallenges\Challenges\MONSTERS_2;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/Petits-monstres-mignons-2
 * @TODO Try implement chain of responsibility pattern
 */
final class Monsters_2 extends Challenge {
	
	protected const USE_DATA_TEST = false;
	protected const ENABLE_LOG    = false;
	
	public function solve() : mixed {
		// Manage the monsters
		$monsters = $this->data[ 'monsters' ] ?? [];
		$monsters = array_map( function( $monster ) {
			// Send null item if the monster is not well formatted
			if ( substr_count( $monster, ':' ) !== 2 ) return null;
			
			[ $name, $weight, $formula ] = explode( ':', $monster );

			return new Monster( $name, $weight, $formula );
		}, $monsters );
		$monsters = new MonsterList( $monsters );

		// Manage the food
		$foods = $this->data[ 'foods' ] ?? [];
		$foods = str_split( $foods, 2 );
		$foods = array_map( fn( $food ) => Food::from_coded_value( $food ), $foods );

		while ( ! empty( $foods ) ) {
			$food    = array_shift( $foods );
			$monster = $monsters->get_the_lightest_who_can_eat( $food->get_type() );
			$monster->eat( $food );
			$monsters->update_monster( $monster );
		}

		$heaviest_monster = $monsters->get_the_heaviest();
		$result           = $heaviest_monster->get_name() . ':' . $heaviest_monster->get_weight();

		return $result;
	}
}