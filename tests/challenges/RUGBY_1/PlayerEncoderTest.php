<?php

use PHPUnit\Framework\TestCase;
use Gturpin\TainixChallenges\Challenges\RUGBY_1\PlayerEncoder;

/**
 * @group RUGBY_1
 */
class PlayerEncoderTest extends TestCase {

	/**
	 * Setup the test environment
	 *
	 * @return void
	 */
	public function setUp() : void {
		parent::setUp();
	}

	public function provider_decode() : array {
		return [
			[ "115:78", 115, 78 ],
			[ "93:32", 93, 32 ],
			[ "85:11", 85, 11 ],
			[ "118:89", 118, 89 ],
			[ "88:37", 88, 37 ],
			[ "93:11", 93, 11 ],
			[ "99:20", 99, 20 ],
			[ "90:99", 90, 99 ],
			[ "92:57", 92, 57 ],
			[ "75:12", 75, 12 ],
			[ "76:57", 76, 57 ],
			[ "76:36", 76, 36 ],
		];
	}
	
	/**
	 * @dataProvider provider_decode
	 *
	 * @return void
	 */
	public function test_decode( string $encoded_stats, int $expected_weight, int $expected_strength ) : void {
		$player_encoder = new PlayerEncoder( $encoded_stats );

		$this->assertSame( $expected_weight, $player_encoder->get_weight() );
		$this->assertSame( $expected_strength, $player_encoder->get_strength() );
	}

	public function provider_decode_exception() : array {
		return [
			[ '85:11:12' ],
			[ '85' ],
			[ '85:11:12:13' ],
			[ '85:11:12:13:14' ],
			[ '85:::' ],
		];
	}
	
	/**
	 * @dataProvider provider_decode_exception
	 * 
	 * @param string $encoded_stats The encoded stats of the player
	 *
	 * @return void
	 */
	public function test_decode_exception( string $encoded_stats ) : void {
		$this->expectException( \InvalidArgumentException::class );

		$player_encoder = new PlayerEncoder( $encoded_stats );
	}
}