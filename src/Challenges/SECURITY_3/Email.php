<?php

namespace Gturpin\TainixChallenges\Challenges\SECURITY_3;

/**
 * Model for an email address that will be sanitized
 */
final class Email {

	public function __construct(
		private string $email
	) {}

	/**
	 * Sanitize the email address
	 * Remove every number and every special character except the @ and the .
	 * 
	 * @return string The sanitized email address
	 */
	public function sanitize(): string {
		$email = $this->email;

		// accept only letters, @ and .
		$email = preg_replace( '/[^a-zA-Z@.]/', '', $email );

		return $email;
	}
}