<?php

namespace Gturpin\TainixChallenges\Challenges\NOEL_2023_1;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/pole-express
 */
final class Noel_2023_1 extends Challenge {
	
	protected const USE_DATA_TEST = false;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		$orders             = $this->data['orders'] ?? [];
		$orders             = array_map( fn ( $order ) => Order::from_raw( $order ), $orders );
		$orders_temperature = array_reduce( $orders, function( $total_temperature, $order ) {
			$order->prepare();

			return $total_temperature + $order->get_temperature();
		}, 0 );

		$result = (int) ceil( $orders_temperature / count( $orders ) );

		return $result;
	}
}