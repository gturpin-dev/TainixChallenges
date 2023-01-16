<?php

namespace Gturpin\TainixChallenges\Challenges\SURVIVAL_2;

use Gturpin\TainixChallenges\Challenge;
use Gturpin\TainixChallenges\Challenges\SURVIVAL_2\Human;
use Gturpin\TainixChallenges\Challenges\SURVIVAL_2\Island;

/**
 * @link https://tainix.fr/challenge/Survie-sur-une-ile-deserte-2
 */
final class Survival_2 extends Challenge {
	
	public function solve() : mixed {
		$data_me['thirst'] = $this->data['thirst'];
		$data_me['hunger'] = $this->data['hunger'];
		$data_me['energy'] = $this->data['shape'];
		
		$me     = new Human( $data_me );
		$island = new Island( $this->data['island'] ?? [] );

		$me->explore_island( $island );

		// Make a valid response, neither of the values can be 0 and we need to multiply them
		$thirst   = $me->get_thirst() <= 0 ? 1 : $me->get_thirst();
		$hunger   = $me->get_hunger() <= 0 ? 1 : $me->get_hunger();
		$energy   = $me->get_energy() <= 0 ? 1 : $me->get_energy();
		$response = $thirst * $hunger * $energy;
		
		self::log( 'Total: ' . $response );

		return $response;
	}
}