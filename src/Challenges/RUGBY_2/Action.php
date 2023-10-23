<?php

namespace Gturpin\TainixChallenges\Challenges\RUGBY_2;

/**
 * Modelize a rugby action and its points
 */
enum Action : string {
	case TRY        = 'E';
	case CONVERSION = 'T';
	case PENALTY    = 'P';
	case DROP       = 'D';
}