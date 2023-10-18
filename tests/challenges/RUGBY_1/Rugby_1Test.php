<?php

use PHPUnit\Framework\TestCase;
use Gturpin\TainixChallenges\Challenges\RUGBY_1\Rugby_1;

/**
 * @group RUGBY_1
 */
class Rugby_1Test extends TestCase {

	/**
	 * Setup the test environment
	 *
	 * @return void
	 */
	public function setUp() : void {
		parent::setUp();

		$this->challenge = new Rugby_1( 'RUGBY_1' );
	}

	public function test_basic_solve() {
		$this->challenge->set_data( [
			'line1' => [ '85:11', '89:52', '95:24' ],
			'line2' => [ '89:87','100:58','109:27','95:96' ],
			'line3' => [ '98:48' ],
		] );
		$expected = 40898;

		$this->assertSame( $expected, $this->challenge->solve() );
	}
}