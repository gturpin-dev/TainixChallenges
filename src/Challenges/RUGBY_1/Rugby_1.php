<?php

namespace Gturpin\TainixChallenges\Challenges\RUGBY_1;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/Coupe-du-monde-de-rugby-La-melee
 */
final class Rugby_1 extends Challenge {
	
	protected const USE_DATA_TEST = false;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		$lines   = $this->data ?? [];
		$players = [];

		// Parse the data to get the players and flatten the array to get a list of players
		foreach ( $lines as $player_line => $raw_players ) {
			$players = array_merge(
				$players,
				array_map( function( $encoded_stats ) use ( $player_line ) {
					$encoder  = new PlayerEncoder( $encoded_stats );
					return new Player( PlayerLine::from( $player_line ), $encoder->get_weight(), $encoder->get_strength() );
				}, $raw_players )
			);
		}

		$total_impact_power = array_reduce( $players, fn( $impact_power, $player ) => $impact_power + $player->get_impact_power(), 0 );

		return $total_impact_power;
	}
}