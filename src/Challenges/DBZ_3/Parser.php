<?php

namespace Gturpin\TainixChallenges\Challenges\DBZ_3;

final class Parser {
	
	/**
	 * Parse a string to get an array of data
	 *
	 * @param string $data
	 *
	 * @return array
	 */
	public static function parse( string $data ) : array {
		if ( empty( $data ) ) return [];

		$stats = explode( ' ', $data );
		$data  = [];
		array_walk( $stats, function( $stat ) use ( &$data ) {
			[ $key, $value ] = array_pad( explode( ':', $stat ), 2, ':' );

			$key = match ( $key ) {
				'HP'    => 'hp',
				'F'     => 'strength',
				'S'     => 'super',
				default => throw new \Exception( 'Invalid key' ),
			};
			
			$data[ $key ] = $value;
		} );
		
		return $data;
	}
}