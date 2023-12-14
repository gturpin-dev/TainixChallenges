<?php

namespace Gturpin\TainixChallenges\Challenges\NOEL_2023_1;

use Gturpin\TainixChallenges\Challenges\NOEL_2023_1\Event;
use Gturpin\TainixChallenges\Challenges\NOEL_2023_1\SpiceType;
use Gturpin\TainixChallenges\Challenges\NOEL_2023_1\ChocolateType;

/**
 * Modelize an order
 */
final class Order {
	public function __construct(
		protected int $temperature,
		protected readonly ?ChocolateType $chocolate_type,
		protected readonly ?SpiceType $spice_type,
		protected readonly ?Event $event_type,
	) {}
	
	/**
	 * Parse raw data to create an order
	 *
	 * @param string $raw_data Raw data
	 *
	 * @return self
	 */
	public static function from_raw( string $raw_data ): self {
		[$temperature, $chocolate_type, $spice_type, $event_type] = array_pad( explode( ',', $raw_data ), 4, null );

		$chocolate_type = ChocolateType::tryFrom( $chocolate_type );
		$spice_type     = SpiceType::tryFrom( $spice_type );
		$event_type     = Event::tryFrom( $event_type );
		
		return new self(
			$temperature,
			$chocolate_type,
			$spice_type,
			$event_type,
		);
	}

	/**
	 * Prepare the order
	 * The temperature will vary depending on the chocolate type, the spice type and the event type in that order
	 *
	 * @return void
	 */
	public function prepare(): void {
		$this->handle_chocolate_type();
		$this->handle_spice_type();
		$this->handle_event_type();
	}

	protected function handle_chocolate_type(): void {
		$this->temperature = match( $this->chocolate_type ) {
			ChocolateType::NOIR    => $this->temperature + 5,
			ChocolateType::AU_LAIT => $this->temperature + 10,
			ChocolateType::BLANC   => $this->temperature + 15,
			ChocolateType::MELANGE => $this->temperature + 12,
			default                => $this->temperature,
		};
	}

	protected function handle_spice_type(): void {
		$this->temperature = match( $this->spice_type ) {
			SpiceType::CANNELLE => $this->temperature + 4,
			SpiceType::MUSCADE  => $this->temperature + 7,
			SpiceType::PIMENT   => $this->temperature + 9,
			SpiceType::VANILLE  => $this->temperature + 1,
			default             => $this->temperature,
		};
	}

	protected function handle_event_type(): void {
		$this->temperature = match( $this->event_type ) {
			Event::CHOCOLAT_BRULE => $this->temperature - 10,
			Event::EPICE_SURPRISE => $this->temperature + 10,
			Event::TASSE_FROIDE   => $this->temperature * 2,
			default               => $this->temperature,
		};
	}

	public function get_temperature(): int {
		return $this->temperature;
	}
}