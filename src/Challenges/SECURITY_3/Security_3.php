<?php

namespace Gturpin\TainixChallenges\Challenges\SECURITY_3;

use Gturpin\TainixChallenges\Challenge;

/**
 * @link https://tainix.fr/challenge/Donnees-a-nettoyer
 */
final class Security_3 extends Challenge {
	
	protected const USE_DATA_TEST = false;
	protected const ENABLE_LOG    = true;
	
	public function solve() : mixed {
		$emails       = $this->data['informations'] ?? [];
		$chosen_mails = $this->data['choices'] ?? [];

		// Sanitize the emails
		$emails = array_map( fn( $email ) => new Email( $email ), $emails );
		$emails = array_map( fn( $email ) => $email->sanitize(), $emails );
		$emails = array_values( $emails );

		// Filter out the emails that are not in the choices list ( indexes )
		$emails = array_map( function( $key ) use ( $emails ) {
			return $emails[ $key ] ?? null;
		}, $chosen_mails );

		// Remove null values and concatenate the emails
		$emails = array_filter( $emails );
		$result = implode( ',', $emails );
		
		return $result;
	}
}