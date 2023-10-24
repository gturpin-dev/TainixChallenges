<?php

use PHPUnit\Framework\TestCase;
use Gturpin\TainixChallenges\Challenges\RUGBY_2\Score;
use Gturpin\TainixChallenges\Challenges\RUGBY_2\Action;

/**
 * @group RUGBY_2
 */
class ScoreTest extends TestCase {

	/**
	 * Setup the test environment
	 *
	 * @return void
	 */
	public function setUp() : void {
		parent::setUp();
	}

	public function provider_filter_actions() : array {
		return [
			[ // Remove bad action
				'actions' => [
					Action::TRY,
					Action::DROP,
					Action::CONVERSION
				],
				'expected' => [
					Action::TRY,
					Action::DROP
				]
			],
			[ // Remove multiple bad actions
				'actions' => [
					Action::TRY,
					Action::DROP,
					Action::CONVERSION,
					Action::DROP,
					Action::PENALTY,
					Action::CONVERSION
				],
				'expected' => [
					Action::TRY,
					Action::DROP,
					Action::DROP,
					Action::PENALTY,
				]
			],
			[ // Remove multiple following bad actions
				'actions' => [
					Action::TRY,
					Action::DROP,
					Action::CONVERSION,
					Action::CONVERSION,
				],
				'expected' => [
					Action::TRY,
					Action::DROP,
				]
			],
			[ // Not removing good action
				'actions' => [
					Action::TRY,
					Action::CONVERSION,
					Action::TRY,
					Action::CONVERSION,
				],
				'expected' => [
					Action::TRY,
					Action::CONVERSION,
					Action::TRY,
					Action::CONVERSION,
				]
			],
			[ // Remove bad action even if it's first item of the array
				'actions' => [
					Action::CONVERSION,
					Action::TRY,
				],
				'expected' => [
					Action::TRY,
				]
			]
		];
	}
	
	/**
	 * @dataProvider provider_filter_actions
	 *
	 * @param array<Action> $actions The actions of the game
	 * @param array<Action> $expected The expected actions after filtering
	 *
	 * @return void
	 */
	public function test_filter_actions( array $actions, array $expected ) : void {
		$score = new Score();
		$score->filter_actions( $actions );

		$this->assertSame( array_values( $expected ), array_values( $score->get_actions() ) );
	}

	public function provider_get_total() : array {
		return [
			[ // No action
				'actions' => [],
				'expected' => 0
			],
			[ // Only Try
				'actions' => [
					Action::TRY
				],
				'expected' => 5
			],
			[ // Only Try and Conversion
				'actions' => [
					Action::TRY,
					Action::CONVERSION
				],
				'expected' => 7
			],
			[ // Only Try and Conversion
				'actions' => [
					Action::TRY,
					Action::CONVERSION,
					Action::TRY,
					Action::CONVERSION
				],
				'expected' => 14
			],
			[ // Try and Drop
				'actions' => [
					Action::TRY,
					Action::DROP
				],
				'expected' => 8
			],
			[ // Drop and Penalty
				'actions' => [
					Action::DROP,
					Action::PENALTY
				],
				'expected' => 6
			],
			[ // Try, Drop and Penalty
				'actions' => [
					Action::TRY,
					Action::DROP,
					Action::PENALTY
				],
				'expected' => 11
			],
			[ // Try, Drop, Penalty and Conversion
				'actions' => [
					Action::DROP,
					Action::PENALTY,
					Action::TRY,
					Action::CONVERSION
				],
				'expected' => 13
			],
			[ // Try, Drop, Penalty and wrong Conversion
				'actions' => [
					Action::TRY,
					Action::DROP,
					Action::PENALTY,
					Action::CONVERSION,
					Action::TRY,
					Action::DROP,
					Action::PENALTY,
					Action::CONVERSION
				],
				'expected' => 22
			],
			[ // Try, Drop, Penalty and good Conversion
				'actions' => [
					Action::TRY,
					Action::DROP,
					Action::PENALTY,
					Action::TRY,
					Action::CONVERSION,
					Action::DROP,
					Action::PENALTY,
					Action::CONVERSION
				],
				'expected' => 24
			],
		];
	}

	/**
	 * @dataProvider provider_get_total
	 *
	 * @param array<Action> $actions The actions of the game
	 * @param integer $expected The expected total
	 *
	 * @return void
	 */
	public function test_get_total( array $actions, int $expected ) : void {
		$score = new Score();
		$score->filter_actions( $actions );

		$this->assertSame( $expected, $score->get_total() );
	}
}