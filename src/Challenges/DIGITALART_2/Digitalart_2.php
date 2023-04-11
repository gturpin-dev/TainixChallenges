<?php

namespace Gturpin\TainixChallenges\Challenges\DIGITALART_2;

use Illuminate\Support\Collection;
use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/CTC-2-La-douche-froide
 */
final class Digitalart_2 extends Challenge {
	
	protected const USE_DATA_TEST = false;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		$tweets   = new Collection( $this->data['tweets'] ?? [] );
		$displays = new Collection();

		$tweets->each( function( $tweet ) use ( &$displays ) {
			[ $tweet_displays, $accounts ] = explode( ';', $tweet );
			$accounts                      = new Collection( explode( ',', $accounts ) );

			$accounts->each( function( $account ) use ( &$displays, &$tweet_displays ) {
				if ( ! isset( $displays[ $account ] ) ) {
					$displays[ $account ] = 0;
				}
				
				$displays[ $account ] += $tweet_displays;
			} );
		} );
		
		$displays         = $displays->sort()->reverse();
		$original_account = $displays->keys()->first();
		$total_displays   = $original_account ? $displays->get( $original_account ) : 0;
		$response         = $original_account . ':' . $total_displays;
		
		return $response;
	}
}