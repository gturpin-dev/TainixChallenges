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
		$actions        = array_values( $actions );  // Reset the keys
		$keys_to_remove = [];                        // To ensure we don't remove an action while looping
		
		foreach ( $actions as $key => $action ) {
			// Bail if not a Conversion
			if ( $action !== Action::CONVERSION ) continue;

			// Bail if key doesn't exist
			$previous_key = $key - 1;
			if ( ! array_key_exists( $previous_key, $actions ) ) continue;
			
			// Remove the Conversion if there is no Try before
			$previous_action = $actions[ $previous_key ] ?? null;
			if ( $previous_action !== Action::TRY ) {
				$keys_to_remove[] = $key;
			}
		}

		// Remove the actions
		foreach ( $keys_to_remove as $key ) {
			unset( $actions[ $key ] );
		}

		$this->actions = $actions;
	}

	/**
	 * Get the total score of the actions
	 *
	 * @return integer The total score
	 */
	public function get_total() : int {
		$total = array_reduce( $this->actions, fn( $score, $action ) => $score + $action->get_points(), 0 );

		return $total;
	}
}