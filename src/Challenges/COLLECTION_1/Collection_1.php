<?php

namespace Gturpin\TainixChallenges\Challenges\COLLECTION_1;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/Collectionneur-de-figurines
 */
final class Collection_1 extends Challenge {
	
	protected const USE_DATA_TEST = false;
	protected const ENABLE_LOG    = false;
	
	public function solve() : mixed {
		$copies     = $this->data[ 'exemplaires' ] ?? [];
		$odds       = $this->data[ 'cotes' ] ?? [];
		$max_length = max( count( $copies ), count( $odds ) );
		$odds       = array_pad( $odds, $max_length, 0 );
		$copies     = array_pad( $copies, $max_length, 0 );

		// Create a collection of figurine
		$collection = array_map( function( $copy, $odd ) {
			return new Figurine( $copy, $odd );
		}, $copies, $odds );

		// Calculate the profit
		$bought_value = array_reduce( $collection, fn( $total_value, $figurine ) => $total_value + $figurine->get_bought_value(), 0 );
		$sold_value   = array_reduce( $collection, fn( $total_value, $figurine ) => $total_value + $figurine->get_sold_value(), 0 );
		$profit       = $sold_value - $bought_value;

		return $profit;
	}
}