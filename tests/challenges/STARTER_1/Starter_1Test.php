<?php

use PHPUnit\Framework\TestCase;
use Gturpin\TainixChallenges\Challenges\STARTER_1\Starter_1;

/**
 * @group STARTER_1
 */
class Starter_1Test extends TestCase {

	/**
	 * Set up the test environment
	 *
	 * @return void
	 */
	public function setUp() : void {
		parent::setUp();

		$this->challenge = new Starter_1( 'STARTER_1' );
	}

	public function test_basic_solve() {
		$this->challenge->set_data( [
			'side' => 87,
		] );
		$expected = 7917;

		$this->assertSame( $expected, $this->challenge->solve() );
	}

	public function test_wrong_path() {
		$this->challenge->set_data( [
			'side' => 87,
		] );
		$expected = 7918;

		$this->assertNotSame( $expected, $this->challenge->solve() );
	}
}