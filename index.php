<?php

use Gturpin\TainixChallenges\ChallengeFactory;

require_once __DIR__ . '/vendor/autoload.php';

$challenge_factory = new ChallengeFactory();
// $challenge_factory->solve( 'POKEMON_1' );
// $challenge_factory->solve( 'GEOMETRY_1' );
$challenge_factory->solve( 'CRYPTO_2' );