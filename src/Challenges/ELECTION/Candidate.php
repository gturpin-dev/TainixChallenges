<?php

namespace Gturpin\TainixChallenges\Challenges\ELECTION;

final readonly class Candidate {
	public function __construct(
		private string $name
	) {}

	public function get_name(): string {
		return $this->name;
	}
}