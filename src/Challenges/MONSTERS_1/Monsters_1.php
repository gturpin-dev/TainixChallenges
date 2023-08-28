<?php

namespace Gturpin\TainixChallenges\Challenges\MONSTERS_1;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/Petits-monstres-mignons-1
 */
final class Monsters_1 extends Challenge {
	
	protected const USE_DATA_TEST = false;
	protected const ENABLE_LOG    = false;
	
	public function solve() : mixed {
		$weight  = $this->data[ 'weight' ] ?? 0;
		$formula = $this->data[ 'formula' ] ?? '';
		$foods   = $this->data[ 'foods' ] ?? '';
		$foods   = str_split( $foods );
		$foods   = array_map( fn( $food ) => FoodType::tryFrom( $food ) ?? null, $foods );
		$foods   = array_filter( $foods );
		$monster = new Monster( $formula, $weight );

		while ( ! empty( $foods ) ) {
			$food = array_shift( $foods );
			$monster->eat( $food );
		}

		$result = $monster->get_weight();

		return $result;
	}
}