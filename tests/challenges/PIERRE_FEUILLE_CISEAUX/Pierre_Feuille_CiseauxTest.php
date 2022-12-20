<?php

use PHPUnit\Framework\TestCase;
use Gturpin\TainixChallenges\Challenges\PIERRE_FEUILLE_CISEAUX\RPC_Helper;
use Gturpin\TainixChallenges\Challenges\PIERRE_FEUILLE_CISEAUX\Pierre_Feuille_Ciseaux;

/**
 * @group PIERRE_FEUILLE_CISEAUX
 */
class Pierre_Feuille_CiseauxTest extends TestCase {

	/**
	 * Set up the test environment
	 *
	 * @return void
	 */
	public function setUp() : void {
		parent::setUp();
		$this->rpc_helper = new RPC_Helper();
	}
	
	/**
	 * @group Solve
	 *
	 * @return void
	 */
	public function test_solve() : void {
		$challenge = new Pierre_Feuille_Ciseaux( 'PIERRE_FEUILLE_CISEAUX',  [
			'coups' => 'FFPPPC',
		] );
		$this->assertSame( 'CCFFFP', $challenge->solve() );
	}

	/**
	 * @group Solve
	 *
	 * @return void
	 */
	public function test_solve_with_invalid_data() : void {
		$challenge = new Pierre_Feuille_Ciseaux( 'PIERRE_FEUILLE_CISEAUX',  [
			'coups' => 'FFPPXPC',
		] );
		$this->assertSame( 'CCFFFP', $challenge->solve() );
	}

	/**
	 * @group Methods
	 *
	 * @return void
	 */
	public function test_rock_gives_paper() : void {
		$this->assertSame( 'F', $this->rpc_helper->get_choice_to_win( 'P' ) );
	}

	/**
	 * @group Methods
	 *
	 * @return void
	 */
	public function test_paper_gives_scissors() : void {
		$this->assertSame( 'C', $this->rpc_helper->get_choice_to_win( 'F' ) );
	}

	/**
	 * @group Methods
	 *
	 * @return void
	 */
	public function test_scissors_gives_rock() : void {
		$this->assertSame( 'P', $this->rpc_helper->get_choice_to_win( 'C' ) );
	}

	/**
	 * @group Methods
	 *
	 * @return void
	 */
	public function test_invalid_choice_gives_null() : void {
		$this->assertNull( $this->rpc_helper->get_choice_to_win( 'X' ) );
	}

	/**
	 * @group Methods
	 *
	 * @return void
	 */
	public function test_empty_choice_gives_null() : void {
		$this->assertNull( $this->rpc_helper->get_choice_to_win( '' ) );
	}
}