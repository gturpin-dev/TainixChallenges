<?php

use PHPUnit\Framework\TestCase;
use Gturpin\TainixChallenges\Challenges\FOOTBALL_3\Football_3;
use Gturpin\TainixChallenges\Challenges\FOOTBALL_3\Match_Handler;

/**
 * @group FOOTBALL_3
 */
final class Football_3Test extends TestCase {

	/**
	 * @group Solve
	 * 
	 * @return void
	 */
	public function test_solve() : void {
		$challenge = new Football_3( 'FOOTBALL_3', [
			'group' => [
				'ITA',
				'REP',
				'ALL',
				'SLO'
			],
			'scores' => [
				'ITA_REP_3_2', 
				'ITA_ALL_0_1', 
				'ITA_SLO_1_1', 
				'REP_ITA_0_2', 
				'REP_ALL_0_2', 
				'REP_SLO_0_2', 
				'ALL_ITA_2_1', 
				'ALL_REP_0_2', 
				'ALL_SLO_0_0', 
				'SLO_ITA_2_0', 
				'SLO_REP_3_3', 
				'SLO_ALL_0_0'
			]
		] );

		$this->assertSame( 'ALLSLOITAREP', $challenge->solve() );
	}

	/**
	 * Test parse_score method
	 * @group Methods
	 *
	 * @return void
	 */
	public function test_parse_score() {
		$match_handler = new Match_Handler( [
			'ITA',
			'REP',
			'ALL',
			'SLO'
		] );

		$score = $match_handler->parse_score( 'ITA_REP_3_2' );

		$this->assertTrue( is_array( $score ) );
		$this->assertTrue( array_key_exists( 'ITA', $score ) );
		$this->assertTrue( array_key_exists( 'REP', $score ) );
		$this->assertSame( 3, $score['ITA'] );
		$this->assertSame( 2, $score['REP'] );

		$score = $match_handler->parse_score( 'ITA_ALL_0_1' );

		$this->assertTrue( array_key_exists( 'ITA', $score ) );
		$this->assertTrue( array_key_exists( 'ALL', $score ) );
		$this->assertSame( 0, $score['ITA'] );
		$this->assertSame( 1, $score['ALL'] );
	}

	/**
	 * Test parse_score method with wrong team name in score
	 * @group Methods
	 *
	 * @return void
	 */
	public function test_wrong_team_parse_score() {
		$match_handler = new Match_Handler( [
			'ITA',
			'REP',
			'ALL',
			'SLO'
		] );

		$this->expectException( \Exception::class );
		$this->expectExceptionMessage( 'Invalid team name' );
		
		$match_handler->parse_score( 'FRA_BEL_3_2' );
	}

	/**
	 * Test multiple results of matchs and the associated ranks
	 * @group Methods
	 *
	 * @return void
	 */
	public function test_add_score() {
		$match_handler = new Match_Handler( [
			'ITA',
			'REP',
			'ALL',
			'SLO'
		] );

		$match_handler->add_score( [
			'ITA' => 3,
			'REP' => 2
		] );

		$match_handler->add_score( [
			'ALL' => 2,
			'SLO' => 2
		] );

		$this->assertEquals( [
			'ITA' => 3,
			'REP' => 0,
			'ALL' => 1,
			'SLO' => 1
		], $match_handler->get_ranks() );
		
		$match_handler->add_score( [
			'ITA' => 0,
			'SLO' => 0
		] );

		$this->assertEquals( [
			'ITA' => 4,
			'REP' => 0,
			'ALL' => 1,
			'SLO' => 2
		], $match_handler->get_ranks() );
	}

	/**
	 * @group Methods
	 *
	 * @return void
	 */
	public function test_match_home_win() : void {
		$match_handler = new Match_Handler( [
			'ITA',
			'REP',
			'ALL',
			'SLO'
		] );

		$score = $match_handler->parse_score( 'ITA_REP_3_2' );
		$match_handler->add_score( $score );

		$this->assertEquals( [
			'ITA' => 3,
			'REP' => 0,
			'ALL' => 0,
			'SLO' => 0
		], $match_handler->get_ranks() );
	}

	/**
	 * @group Methods
	 *
	 * @return void
	 */
	public function test_match_away_win() : void {
		$match_handler = new Match_Handler( [
			'ITA',
			'REP',
			'ALL',
			'SLO'
		] );

		$score = $match_handler->parse_score( 'ITA_REP_2_3' );
		$match_handler->add_score( $score );

		$this->assertEquals( [
			'ITA' => 0,
			'REP' => 3,
			'ALL' => 0,
			'SLO' => 0
		], $match_handler->get_ranks() );
	}

	/**
	 * @group Methods
	 *
	 * @return void
	 */
	public function test_match_draw() : void {
		$match_handler = new Match_Handler( [
			'ITA',
			'REP',
			'ALL',
			'SLO'
		] );

		$score = $match_handler->parse_score( 'ITA_REP_2_2' );
		$match_handler->add_score( $score );

		$this->assertEquals( [
			'ITA' => 1,
			'REP' => 1,
			'ALL' => 0,
			'SLO' => 0
		], $match_handler->get_ranks() );
	}
}