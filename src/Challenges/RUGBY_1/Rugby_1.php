<?php

namespace Gturpin\TainixChallenges\Challenges\RUGBY_1;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/Coupe-du-monde-de-rugby-La-melee
 */
final class Rugby_1 extends Challenge {
	
	protected const USE_DATA_TEST = true;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		dump( $this->data );

		$first_line  = $this->data['line1'] ?? [];
		$second_line = $this->data['line2'] ?? [];
		$third_line  = $this->data['line3'] ?? [];

		// For each players, create a Player object with their coded form
		$first_line_players = array_map( function( $encoded_stats ) {
			$encoder  = new PlayerEncoder( $encoded_stats );
			return new Player( 'first_line', $encoder->get_weight(), $encoder->get_strength() );
		}, $first_line );

		$second_line_players = array_map( function( $encoded_stats ) {
			$encoder  = new PlayerEncoder( $encoded_stats );
			return new Player( 'second_line', $encoder->get_weight(), $encoder->get_strength() );
		}, $second_line );
		
		$third_line_players = array_map( function( $encoded_stats ) {
			$encoder  = new PlayerEncoder( $encoded_stats );
			return new Player( 'third_line', $encoder->get_weight(), $encoder->get_strength() );
		}, $third_line );

		$players            = [ ...$first_line_players, ...$second_line_players, ...$third_line_players ];
		$total_impact_power = array_reduce( $players, fn( $impact_power, $player ) => $impact_power + $player->get_impact_power(), 0 );

		dump( $total_impact_power);
		
		dd($players);

		die;
	}
}