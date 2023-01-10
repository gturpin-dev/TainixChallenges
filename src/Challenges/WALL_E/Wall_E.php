<?php

namespace Gturpin\TainixChallenges\Challenges\WALL_E;

use Gturpin\TainixChallenges\Challenge;
use Gturpin\TainixChallenges\Challenges\WALL_E\WallE;
use Gturpin\TainixChallenges\Challenges\WALL_E\Exceptions\Wall_E_KOException;

/**
 * @link https://tainix.fr/challenge/WALL-E-1
 */
final class Wall_E extends Challenge {
	
	protected const USE_DATA_TEST = true;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		echo '<pre>' . print_r( $this->data, true ) . '</pre>';

		$strength = $this->data['force'] ?? 0;
		$speed    = $this->data['vitesse'] ?? 0;
		$battery  = $this->data['batterie'] ?? 0;
		$wastes   = $this->data['dechets'] ?? [];
		$wall_e   = new WallE( $strength, $speed, $battery );

		while ( $wall_e->is_alive() && ! empty( $wastes ) ) {
			$waste = array_shift( $wastes );
			
			try {
				$treated = $wall_e->collect( $waste );

				if ( $treated ) {
					self::log( 'Waste collected : ' . $waste );
				} else {
					self::log( 'Waste not collected : ' . $waste );
				}
				
				self::log( 'Battery level : ' . $wall_e->get_battery_level() );
			} catch ( Wall_E_KOException $e ) {
				self::log( 'KO : ' . $e->getMessage() );
			}
		}

		self::log( 'Final Battery : ' . $wall_e->get_battery_level() );
		
		die;
	}
}