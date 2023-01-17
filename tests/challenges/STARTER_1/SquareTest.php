<?php

use PHPUnit\Framework\TestCase;
use Gturpin\TainixChallenges\Challenges\STARTER_1\Square;

/**
 * @group STARTER_1
 */
class SquareTest extends TestCase {

	/**
	 * Set up the test environment
	 *
	 * @return void
	 */
	public function setUp() : void {
		parent::setUp();
	}

	public function provider_get_perimeter() : array {
		return [
			[ 1, 4 ],
			[ 4, 16 ],
			[ 87, 348 ],
			[ 100, 400 ],
		];
	}
	
	/**
	 * @dataProvider provider_get_perimeter
	 *
	 * @return void
	 */
	public function test_get_perimeter(
		int $side,
		int $expected
	) : void {
		$square = new Square( $side );

		$this->assertSame( $expected, $square->get_perimeter() );
	}

	public function provider_get_area() : array {
		return [
			[ 1, 1 ],
			[ 4, 16 ],
			[ 87, 7569 ],
			[ 100, 10000 ],
		];
	}

	/**
	 * @dataProvider provider_get_area
	 *
	 * @return void
	 */
	public function test_get_area(
		int $side,
		int $expected
	) : void {
		$square = new Square( $side );

		$this->assertSame( $expected, $square->get_area() );
	}
}