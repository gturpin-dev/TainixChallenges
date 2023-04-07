<?php

namespace Gturpin\TainixChallenges\Challenges\DBZ_2;

class Capsule {

	/**
	 * Get Capsule representation from Item representation
	 *
	 * @param string $item Item representation
	 *
	 * @return string The capsule representation
	 */
	public static function get_representation_by_item( string $item ): string {
		static::check_validity( $item );
		
		$item_code   = static::extract_code_by_item( $item );
		$item_weight = static::extract_weight_by_item( $item );
		
		return $item_code . '-' . $item_weight;
	}

	/**
	 * Extract the code from the Item representation
	 *
	 * @param string $item Item representation
	 *
	 * @return string The code
	 */
	private static function extract_code_by_item( string $item ): string {
		[ $item_code ] = explode( '-', $item );

		$item_code = substr( $item_code, 0, 2 ) . substr( $item_code, - 2 );
		
		return $item_code;
	}

	/**
	 * Extract the weight from the Item representation
	 *
	 * @param string $item Item representation
	 *
	 * @return integer The weight
	 */
	private static function extract_weight_by_item( string $item ): int {
		[ $item_code, $item_weight ] = explode( '-', $item );

		$item_weight = (int) floor( $item_weight / 10 );
		
		return $item_weight;
	}

	/**
	 * Extract the weight from the Item representation
	 *
	 * @param string $item Item representation
	 *
	 * @return integer The weight
	 */
	public static function extract_item_weight_by_item( string $item ): int {
		[ $item_code, $item_weight ] = explode( '-', $item );

		return $item_weight;
	}

	/**
	 * Check the validity of the Item representation
	 *
	 * @param string $item Item representation
	 * 
	 * @throws \InvalidArgumentException If the representation is invalid
	 *
	 * @return void
	 */
	public static function check_validity( string $item ): void {
		if ( ! str_contains( $item, '-' ) ) {
			throw new \InvalidArgumentException( 'Invalid object representation of item : ' . $item . ' (missing dash)');
		}

		[ $code, $weight ] = explode( '-', $item );

		if ( strlen( $code ) < 4 ) {
			throw new \InvalidArgumentException( 'Invalid object representation of item : ' . $item . ' (code must be at least 4 characters long)');
		}

		if ( ! is_numeric( $weight ) ) {
			throw new \InvalidArgumentException( 'Invalid object representation of item : ' . $item . ' (weight must be numeric)');
		}
	}

}