<?php

namespace Gturpin\TainixChallenges\Challenges\PIZZAS;

/**
 * Modelize a pizzaiolo
 * He is unique so we use the singleton pattern
 */
abstract class Pizzaiolo {

	protected function __construct() {
		// to override in child classes
	}

	// prevent cloning
	private function __clone() {}
	
	/**
	 * Return the current instance of the child class
	 *
	 * @return Pizzaiolo the child class
	 */
	final public static function get_instance(): self {
		static $_instance = [];

		$called_class = get_called_class();

		if ( ! array_key_exists( $called_class, $_instance ) ) {
			$_instance[ $called_class ] = new $called_class();
		}

		return $_instance[ $called_class ];
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
	 * Get the pizzaiolo name
	 *
	 * @return string
	 */
	public function get_name() : string {
		return ( new \ReflectionClass( $this ) )->getShortName();
	}
}