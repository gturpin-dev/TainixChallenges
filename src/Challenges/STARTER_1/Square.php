<?php

namespace Gturpin\TainixChallenges\Challenges\STARTER_1;

final class Square {

	public function __construct(
		private int $side
	) {}

	public function get_area() : int {
		return $this->side * $this->side;
	}

	public function get_perimeter() : int {
		return $this->side * 4;
	}
}
