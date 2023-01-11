<?php

namespace Gturpin\TainixChallenges;

/**
 * Class to solve a challenge from the API
 * For each Challenge you need to create a new class that extends this one in challenges/CHALLENGE_CODE/ChallengeName_Code.php
 * Code the solve() method to solve the challenge
 */
abstract class Challenge {

	/**
	 * The challenge code like 'POKEMON_1'
	 */
	protected string $challenge_code;

	/**
	 * The challenge DATA
	 */
	protected array $data;

	/**
	 * Enable the log for this challenge or not
	 */
	protected const ENABLE_LOG = true;

	/**
	 * Enable the data test or not
	 */
	protected const USE_DATA_TEST = false;

	public function __construct( string $challenge_code, array $data = [] ) {
		$this->challenge_code = $challenge_code;
		$this->data           = $data;

		if ( static::USE_DATA_TEST ) {
			$this->data = $this->get_data_test();
		}
	}

	/**
	 * Solve the challenge
	 *
	 * @return mixed The response to the challenge
	 */
	abstract public function solve() : mixed;

	/**
	 * Getting the data stored in the $filename file
	 *
	 * @param string $filename The filename to load from the Challenges/CHALLENGE_CODE/ directory
	 * @param string|null $custom_path The custom path to load the file from
	 *
	 * @return array The data from the file
	 */
	public function get_data_test( string $filename = 'data.json', ?string $custom_path = null ) {
		$path     = $custom_path ?? __DIR__ . '/Challenges/' . $this->challenge_code;
		$filename = $path . '/' . $filename;

		if ( ! file_exists( $filename ) ) {
			throw new \Exception( 'File not found: ' . $filename );
		}

		return json_decode( file_get_contents( $filename ), true );
	}

	/**
	 * Set data for the challenge
	 * Useful for tests
	 *
	 * @param array $data
	 *
	 * @return void
	 */
	public function set_data( array $data ) : void {
		$this->data = $data;
	}

	public function get_data() : array {
		return $this->data;
	}

	/**
	 * Build the object from a json file
	 *
	 * @param string $full_path The full path to the json file
	 *
	 * @return static
	 */
	public static function build_from_dataset( string $full_path ) : static {
		$challenge_code = get_called_class();

		if ( ! file_exists( $full_path ) ) {
			throw new \Exception( 'Dataset file not found: ' . $full_path );
		}

		$data = json_decode( file_get_contents( $full_path ), true );
		
		return new static( $challenge_code, $data );
	}

	/**
	 * Print something
	 * Can be disabled by the ENABLE_LOG constant
	 *
	 * @param mixed $result
	 *
	 * @return void
	 */
	public static function log( mixed $string ) : void {
		if ( ! static::ENABLE_LOG ) {
			return;
		}

		echo $string ?: '';
		echo '<br>';
	}
}