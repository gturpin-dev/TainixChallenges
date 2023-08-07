<?php

namespace Gturpin\TainixChallenges\Challenges\CRYPTO_1;

/**
 * Model for the code to break
 * The code have a list of words
 * Each word is a list of letters
 * At each position of the word, the right letter is the most used letter in the same position of all the words
 * The breaked code is the concatenation of these right letters
 */
final class Code {

	/**
	 * The length of the code
	 */
	private int $code_length;
	
	public function __construct(
		private array $words
	) {
		$this->check_validity();
	}

	/**
	 * Check the validity of the code
	 * The code is valid if all the words have the same length
	 *
	 * @throws \Exception If the code is not valid
	 * 
	 * @return void
	 */
	private function check_validity(): void {
		$words = $this->words;
		
		// Bail early if there is no words
		if ( empty( $words ) ) {
			throw new \Exception( 'The code must contains at least one word' );
		}

		// Get the first word length as reference
		$code_length = array_shift( $words );
		$code_length = strlen( $code_length );

		// if in the rest of the words there is one with a different length, the code is not valid
		foreach ( $words as $word ) {
			$word_length = strlen( $word );

			if ( $code_length !== $word_length ) {
				throw new \Exception( 'The code is not valid, all words must have the same number of letters' );
			}
		}

		$this->code_length = $code_length;
	}
	
	/**
	 * Break the code as defined in the class description
	 *
	 * @return string
	 */
	public function break(): string {
		// Count the number of letters in each position of the words
		$letters_count = $this->count_letters();

		// Get the most used letter in each position
		$most_used_letters = $this->get_most_used_letters( $letters_count );

		// Concatenate the most used letters
		$code = implode( '', $most_used_letters );

		return $code;
	}

	/**
	 * Count the number of letters in each position of the words
	 *
	 * @return array
	 */
	private function count_letters(): array {
		$letters_count = [];

		$words = array_map( 'str_split', $this->words );

		// Count the number of letters in each position of the words
		$letters_count = array_reduce( $words, function( $letters_count, $word ) {
			foreach ( $word as $position => $letter ) {
				$count                                 = $letters_count[ $position ][ $letter ] ?? 0;
				$letters_count[ $position ][ $letter ] = $count + 1;
			}

			return $letters_count;
		}, $letters_count );

		return $letters_count;
	}

	/**
	 * Get the most used letter in each position
	 *
	 * @param array $letters_count The number of letters in each position of the words
	 *
	 * @return array
	 */
	private function get_most_used_letters( array $letters_count ): array {
		$most_used_letters = [];

		// Get the most used letter in each position
		foreach ( $letters_count as $position => $letters ) {
			arsort( $letters );
			$most_used_letters[ $position ] = array_key_first( $letters );
		}

		return $most_used_letters;
	}
}