<?php

namespace Gturpin\TainixChallenges\Challenges\PIERRE_FEUILLE_CISEAUX;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/Pierre-Feuille-Ciseaux
 */
final class Pierre_Feuille_Ciseaux extends Challenge {

	public function solve() : mixed {
		$opponent_choices = $this->data['coups'];
		$opponent_choices = str_split( $opponent_choices );
		$mine_choices     = [];

		foreach ( $opponent_choices as $opponent_choice ) {
			$rpc_helper     = new RPC_Helper();
			$mine           = $rpc_helper->get_choice_to_win( $opponent_choice );
			$mine_choices[] = $mine;
		}

		return implode( '', $mine_choices );
	}
}