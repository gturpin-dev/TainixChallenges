<?php

namespace Gturpin\TainixChallenges\Challenges\GEOMETRY_1;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/Figures-geometriques
 */
final class Geometry_1 extends Challenge {
	
	public function solve() : mixed {
		$shapes          = $this->data['shapes'];
		$total_perimeter = 0;
		
		foreach ( $shapes as $shape ) {
			[ $shape, $side_length ] = explode( '_', $shape );

			$shape = __NAMESPACE__ . '\\Shapes\\' . ucfirst( $shape );
			$shape = new $shape( $side_length );

			$total_perimeter += $shape->get_perimeter();
		}

		return $total_perimeter;
	}
}