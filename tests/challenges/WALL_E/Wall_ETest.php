<?php

use PHPUnit\Framework\TestCase;
use Gturpin\TainixChallenges\Challenges\WALL_E\WallE;
use Gturpin\TainixChallenges\Challenges\WALL_E\Wall_E;
use Gturpin\TainixChallenges\Challenges\WALL_E\Exceptions\Wall_E_KOException;

/**
 * @group WALL_E
 */
class Wall_ETest extends TestCase {

	/**
	 * Set up the test environment
	 *
	 * @return void
	 */
	public function setUp() : void {
		parent::setUp();
	}

	public function test_strength_greater_than_waste() : void {
		$wall_e = new WallE(
			strength: 20,
			speed   : 10,
			battery : 100
		);

		$waste = 18;

		$battery      = $wall_e->get_battery_level();
		$collected    = $wall_e->collect( $waste );
		$battery_used = $battery - $wall_e->get_battery_level();

		$this->assertTrue( $collected );
		$this->assertSame( 1, $battery_used );
	}

	/**
	 * Provider for :
	 * @see test_battery_used_to_collect_waste
	 *
	 * @return array
	 */
	public function provider_battery_used_to_collect_waste() : array {
		// Start battery, waste, expected battery used
		return [
			// If the strength of Wall-E is greater than or equal with the waste, the battery used is 1
			[ 100, 20, 1 ],
			[ 100, 10, 1 ],
			[ 100, 5, 1 ],
			[ 100, 1, 1 ],

			// If Wall-E haven't enough strength, he can use battery to powerup himself

			// 1 strength cost 2 battery
			[ 100, 21, 2 ],
			[ 100, 22, 4 ],
			[ 100, 23, 6 ],
			[ 100, 30, 20 ],
			
			// Same with different amount of battery
			[ 40, 21, 2 ],
			[ 40, 25, 10 ],
			[ 40, 30, 20 ], // The half

			// Wall-E can't use more than the half of current battery to powerup
			// If Wall-E haven't enough battery to powerup himself, he can't collect the waste and lost 2 battery
			[ 40, 35, 2 ],
		];
	}
	
	/**
	 * @dataProvider provider_battery_used_to_collect_waste
	 *
	 * @param integer $start_battery         Battery level at the beginning of the test
	 * @param integer $waste                 Waste to collect
	 * @param integer $expected_battery_used Battery level expected after the test
	 *
	 * @return void
	 */
	public function test_battery_used_to_collect_waste(
		int $start_battery,
		int $waste,
		int $expected_battery_used
	) : void {
		$wall_e = new WallE(
			strength: 20,
			speed   : 10,
			battery : $start_battery
		);

		$battery      = $wall_e->get_battery_level();
		$wall_e->collect( $waste );
		$battery_used = $battery - $wall_e->get_battery_level();

		$this->assertSame( $expected_battery_used, $battery_used );
	}

	/**
	 * Provider for :
	 * @see test_battery_after_charge
	 * 
	 * @return array
	 */
	public function provider_battery_after_charge() : array {
		// Speed - Battery - Expected battery after charge
		return [
			'' => [ 10, 50, 50 ], // No charge
			'' => [ 10, 20, 20 ], // No charge
			'' => [ 10, 18, 90 ], // Charge is good
			'' => [ 10, 11, 90 ], // Charge is good, just right
			'' => [ 10, 10, 0 ]   // Charge failed, battery is empty
		];
	}

	/**
	 * @dataProvider provider_battery_after_charge
	 *
	 * @param integer $speed                 Speed of Wall-E
	 * @param integer $battery               Battery level at the beginning of the test
	 * @param integer $expected_battery_used Battery level expected after the test
	 *
	 * @return void
	 */
	public function test_battery_after_charge(
		int $speed,
		int $battery,
		int $expected_battery
	) : void {
		$wall_e = new WallE(
			strength: 20,
			speed   : $speed,
			battery : $battery
		);

		try {
			$wall_e->maybe_charge();
		} catch ( Wall_E_KOException $e ) {
			$this->assertSame( 0, $wall_e->get_battery_level() );
		}

		$this->assertSame( $expected_battery, $wall_e->get_battery_level() );
	}

	public function test_walle_not_dead() : void {
		$wall_e   = Wall_E::build_from_dataset( __DIR__ . '/dataset/data_not_dead.json' );
		$data     = $wall_e->get_data() ?? [];
		$resultat = $data['resultat'] ?? null;
		
		$this->assertEquals( $resultat, $wall_e->solve() );
	}

	public function test_walle_dead() : void {
		$wall_e   = Wall_E::build_from_dataset( __DIR__ . '/dataset/data_dead.json' );
		$data     = $wall_e->get_data() ?? [];
		$resultat = $data['resultat'] ?? null;

		$this->assertEquals( $resultat, $wall_e->solve() );
	}
}