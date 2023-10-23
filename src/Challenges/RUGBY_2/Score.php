<?php

namespace Gturpin\TainixChallenges\Challenges\RUGBY_2;

/**
 * Modelize the score of a rugby game
 */
final class Score {
	
	/**
	 * Actions that count in the score
	 *
	 * @var array<Action>
	 */
	private array $actions;

	/**
	 * Filter the actions to keep only the ones that count in the score
	 * Remove a Conversion if there is no Try before
	 *
	 * @param array<Action> $actions The actions to filter
	 *
	 * @return void
	 */
	public function filter_actions( array $actions ) : void {
		foreach ( $actions as $key => $action ) {
			// Bail if not a Conversion
			if ( $action !== Action::CONVERSION ) continue;

			// Remove the Conversion if there is no Try before
			$previous_action = $actions[ $key - 1 ] ?? null;
			if ( $previous_action !== Action::TRY ) {
				unset( $actions[ $key ] );
			}
		}

		$this->actions = $actions;
	}

	/**
	 * Get the total score of the actions
	 *
	 * @return integer The total score
	 */
	public function get_total() : int {
		$total = array_reduce( $this->actions, function( $score, $action ) {
			return $score + match ( $action ) {
				Action::TRY        => 5,
				Action::CONVERSION => 2,
				Action::PENALTY    => 3,
				Action::DROP       => 3,
			};
		}, 0 );

		return $total;
	}
}