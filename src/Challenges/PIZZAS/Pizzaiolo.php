<?php

namespace Gturpin\TainixChallenges\Challenges\PIZZAS;

/**
 * Modelize a pizzaiolo
 * He is unique so we use the singleton pattern
 */
abstract class Pizzaiolo {

	public static self $instance;

	/**
	 * Pizzaiolo constructor.
	 */
	protected function __construct() {}

	// Prevent cloning
	private function __clone() {}

	public static function get_instance() : self {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new static();
		}

		return self::$instance;
	}

	/**
	 * Prepare the pizza and return the price
	 *
	 * @param Pizza $pizza The pizza to prepare
	 *
	 * @return integer
	 */
	public abstract function prepare_pizza( Pizza $pizza ) : int;

	/**
	 * Create a pizzaiolo from a string
	 *
	 * @param string $pizzaiolo The pizzaiolo name
	 *
	 * @return self
	 */
	public static function create_from_string( string $pizzaiolo ) : self {
		$pizzaiolo = ucfirst( strtolower( $pizzaiolo ) );
		// replace every special character by its normal version (é => e)
		$pizzaiolo = iconv( 'UTF-8', 'ASCII//TRANSLIT', $pizzaiolo );
		$class     = __NAMESPACE__ . '\\Pizzaiolos\\' . $pizzaiolo;

		if ( ! class_exists( $class ) ) {
			throw new \Exception( 'Pizzaiolo : "' . $pizzaiolo . '" not found' );
		}

		var_dump( $pizzaiolo );
		var_dump( $class );
		var_dump( $class::get_instance() );
		// die;
		// var_dump( $class );
		// return $class;
		return $class::get_instance();
	}

	/**
	 * Get the pizzaiolo name
	 *
	 * @return string
	 */
	public function get_name() : string {
		return ( new \ReflectionClass( $this ) )->getShortName();
	}
}