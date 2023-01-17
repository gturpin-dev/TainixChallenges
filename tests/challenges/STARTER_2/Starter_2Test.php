<?php

use PHPUnit\Framework\TestCase;
use Gturpin\TainixChallenges\Challenges\STARTER_2\Starter_2;

/**
 * @group STARTER_2
 */
class Starter_2Test extends TestCase {

	/**
	 * Set up the test environment
	 *
	 * @return void
	 */
	public function setUp() : void {
		parent::setUp();
	}

	public function test_basic_sentance() {
		$challenge = new Starter_2( 'STARTER_2' );
		$challenge->set_data( [
			'name' => 'Bryan',
			'room' => 'kitchen',
		] );
		$expected  = 'Bryan is in the kitchen.';

		$this->assertSame( $expected, $challenge->solve() );
	}
}