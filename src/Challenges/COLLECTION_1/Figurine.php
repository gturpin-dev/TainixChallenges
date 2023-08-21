<?php

namespace Gturpin\TainixChallenges\Challenges\COLLECTION_1;

final class Figurine {

	/**
	 * The value of the figurine when it was bought
	 */
	public const BOUGHT_BASE_VALUE = 15;

	/**
	 * The value of the figurine when it was bought if it is rare
	 */
	public const BOUGHT_RARE_VALUE = 30;

	/**
	 * Copies needed for the figurine to be rare is less than this number
	 */
	public const COPIES_TO_BE_RARE = 2000;

	/**
	 * The value of the figurine when it was bought
	 */
	private float $bought_value;

	/**
	 * The value of the figurine when it will be sold
	 */
	private float $sold_value;
	
	public function __construct(
		private readonly int $copies,
		private readonly float $odd,
	) {
		$this->calculate_bought_value();
		$this->calculate_sold_value();
	}

	/**
	 * Calculate the bought value of the figurine
	 *
	 * @return void
	 */
	private function calculate_bought_value(): void {
		$this->bought_value = $this->is_rare() ? self::BOUGHT_RARE_VALUE : self::BOUGHT_BASE_VALUE;
	}

	/**
	 * Calculate the sold value of the figurine
	 *
	 * @return void
	 */
	private function calculate_sold_value(): void {
		$this->sold_value = $this->odd * $this->bought_value;
	}


	/**
	 * Get the bought value of the figurine
	 *
	 * @return float
	 */
	public function get_bought_value(): float {
		return $this->bought_value;
	}

	/**
	 * Get the sold value of the figurine
	 *
	 * @return float
	 */
	public function get_sold_value(): float {
		return $this->sold_value;
	}

	/**
	 * Check if the figurine is rare
	 *
	 * @return bool
	 */
	private function is_rare(): bool {
		return $this->copies < self::COPIES_TO_BE_RARE;
	}
}