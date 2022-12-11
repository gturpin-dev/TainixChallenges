<?php

namespace Gturpin\TainixChallenges\Challenges\GEOMETRY_1;

use Gturpin\TainixChallenges\Challenges\GEOMETRY_1\ShapeInterface;

abstract class Polygon implements ShapeInterface {

	/**
	 * The side length of the shape.
	 *
	 * @var int
	 */
	protected $side_length;

	/**
	 * The side number of the shape.
	 *
	 * @var int
	 */
	protected $side_number;

	/**
	 * Shape constructor.
	 *
	 * @param int $side_length The side length of the shape.
	 */
	public function __construct( int $side_length ) {
		$this->side_length = $side_length;
	}

	/**
	 * Get the area of the shape.
	 */
	public function get_area() {
		return pow( $this->side_length, 2 );
	}

	/**
	 * Get the perimeter of the shape.
	 */
	public function get_perimeter() {
		return $this->side_length * $this->side_number;
	}
}