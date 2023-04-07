<?php

namespace Gturpin\TainixChallenges\Challenges\DBZ_2;

use Illuminate\Support\Collection;
use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/Bulma-et-la-Capsule-Corp
 */
final class Dbz_2 extends Challenge {
	
	protected const USE_DATA_TEST = false;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		$items             = new Collection( $this->data['objets'] ?? [] );
		$capsules          = new Collection( $this->data['capsules'] ?? [] );
		$total_weight      = 0;

		$items = $items->filter( function( $item ) use ( $capsules ) {
			return $capsules->contains( Capsule::get_representation_by_item( $item ) );
		} );

		$total_weight = $items->sum( function( $item ) {
			return Capsule::extract_item_weight_by_item( $item );
		} );

		self::log( $total_weight );

		return $total_weight;
	}
}