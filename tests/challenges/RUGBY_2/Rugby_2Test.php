<?php

use Gturpin\TainixChallenges\Challenges\RUGBY_2\Rugby_2;
use PHPUnit\Framework\TestCase;

/**
 * @group RUGBY_2
 */
class Rugby_2Test extends TestCase {
	
	/**
	 * Setup the test environment
	 *
	 * @return void
	 */
	public function setUp() : void {
		parent::setUp();

		$this->challenge = new Rugby_2( 'RUGBY_2' );
	}

	public function test_basic_solve() {
		$this->challenge->set_data( [
			'actions' => 'PEPPD'
		] );
		$expected = 17;

		$this->assertSame( $expected, $this->challenge->solve() );
	}

	public function test_wrong_solve() {
		$this->challenge->set_data( [
			'actions' => 'EETDE'
		] );
		$expected = 23;

		$this->assertNotSame( $expected, $this->challenge->solve() );
	}
}