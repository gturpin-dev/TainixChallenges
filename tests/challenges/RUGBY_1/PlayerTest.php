<?php

use PHPUnit\Framework\TestCase;
use Gturpin\TainixChallenges\Challenges\RUGBY_1\Player;
use Gturpin\TainixChallenges\Challenges\RUGBY_1\PlayerLine;

/**
 * @group RUGBY_1
 */
class PlayerTest extends TestCase {

	/**
	 * Setup the test environment
	 *
	 * @return void
	 */
	public function setUp() : void {
		parent::setUp();
	}

	public function provider_get_impact_power() : array {
		return [
			// tests for line1 ( specific coeff )
			[ 'line1', 85, 11, 1402 ],
			[ 'line1', 118, 89, 15753 ],
			[ 'line1', 88, 37, 4884 ],
			[ 'line1', 93, 11, 1534 ],

			// tests for line2 ( specific coeff )
			[ 'line2', 99, 20, 1980 ],
			[ 'line2', 90, 99, 8910 ],
			[ 'line2', 92, 57, 5244 ],

			// tests for line3 ( specific coeff )
			[ 'line3', 75, 12, 675 ],
			[ 'line3', 76, 57, 3249 ],
			[ 'line3', 76, 36, 2052 ],
		];
	}

	/**
	 * @dataProvider provider_get_impact_power
	 * 
	 * @param string $line     The line of the player
	 * @param int    $weight   The weight of the player
	 * @param int    $strength The strength of the player
	 * @param int    $expected The expected impact power
	 *
	 * @return void
	 */
	public function test_get_impact_power( string $line, int $weight, int $strength, int $expected ) {
		$player = new Player( PlayerLine::from( $line ), $weight, $strength );

		$this->assertSame( $expected, $player->get_impact_power() );
	}
}