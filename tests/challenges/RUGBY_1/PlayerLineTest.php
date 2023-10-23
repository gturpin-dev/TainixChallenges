<?php

use PHPUnit\Framework\TestCase;
use Gturpin\TainixChallenges\Challenges\RUGBY_1\PlayerLine;

/**
 * @group RUGBY_1
 */
class PlayerLineTest extends TestCase {

	/**
	 * Setup the test environment
	 *
	 * @return void
	 */
	public function setUp() : void {
		parent::setUp();
	}

	public function test_enum_cases() {
		$this->assertSame( 'line1', PlayerLine::FIRST_LINE->value );
		$this->assertSame( 'line2', PlayerLine::SECOND_LINE->value );
		$this->assertSame( 'line3', PlayerLine::THIRD_LINE->value );

		$this->assertSame( PlayerLine::from( 'line1' ), PlayerLine::FIRST_LINE );
		$this->assertSame( PlayerLine::from( 'line2' ), PlayerLine::SECOND_LINE );
		$this->assertSame( PlayerLine::from( 'line3' ), PlayerLine::THIRD_LINE );
	}

	public function test_impact_factor() {
		$this->assertSame( 1.5, PlayerLine::FIRST_LINE->get_impact_factor() );
		$this->assertEquals( 1, PlayerLine::SECOND_LINE->get_impact_factor() );
		$this->assertSame( .75, PlayerLine::THIRD_LINE->get_impact_factor() );
	}
}