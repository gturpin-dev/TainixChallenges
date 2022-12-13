<?php

use Gturpin\TainixChallenges\ChallengeFactory;

require_once __DIR__ . '/vendor/autoload.php';

$challenge_factory = new ChallengeFactory();
$challenge_factory->solve( 'DBZ_1' );