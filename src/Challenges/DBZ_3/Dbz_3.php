<?php

namespace Gturpin\TainixChallenges\Challenges\DBZ_3;

use Gturpin\TainixChallenges\Challenge;
use Gturpin\TainixChallenges\Challenges\DBZ_3\Sayan;
use Gturpin\TainixChallenges\Challenges\DBZ_3\Parser;

/**
 * @link https://tainix.fr/challenge/Entrainement-Sangoku-et-Vegeta
 */
final class Dbz_3 extends Challenge {
	
	public function solve() : mixed {
		$data_vegeta  = Parser::parse( $this->data['vegeta'] ?? [] );
		$data_sangoku = Parser::parse( $this->data['sangoku'] ?? [] );

		$vegeta    = new Sayan( $data_vegeta );
		$sangoku   = new Sayan( $data_sangoku );

		// While both are alive, fight them
		$turn_count = 1;
		while ( true ) {
			self::log( 'Turn number ' . $turn_count );
			
			$vegeta->attack( $sangoku );
			$sangoku->attack( $vegeta );

			self::log( 'Sangoku HP : ' . $sangoku->get_hp() . ' --- ' . 'Vegeta HP : ' . $vegeta->get_hp() );
			self::log( '' );
			
			if ( $vegeta->is_dead() || $sangoku->is_dead() ) {
				break;
			}
			
			$turn_count++;
		}

		return match ( true ) {
			$vegeta->is_dead() && $sangoku->is_dead() => 'DRAW_' . $turn_count,
			$vegeta->is_dead()                        => 'SANGOKU_' . $turn_count . '_' . $sangoku->count_special_attack_done(),
			$sangoku->is_dead()                       => 'VEGETA_' . $turn_count . '_' . $vegeta->count_special_attack_done(),
		};
	}
}