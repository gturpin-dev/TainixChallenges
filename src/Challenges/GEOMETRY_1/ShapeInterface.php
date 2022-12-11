<?php

namespace Gturpin\TainixChallenges\Challenges\GEOMETRY_1;

interface ShapeInterface {

	/**
	 * Get the area of the shape.
	 */
	public function get_area();

	/**
	 * Get the perimeter of the shape.
	 */
	public function get_perimeter();
}