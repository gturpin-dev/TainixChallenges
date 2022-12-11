<?php

namespace Gturpin\TainixChallenges\Challenges\GEOMETRY_1\Shapes;

use Gturpin\TainixChallenges\Challenges\GEOMETRY_1\Polygon;
use Gturpin\TainixChallenges\Challenges\GEOMETRY_1\ShapeInterface;

final class Pentagon extends Polygon implements ShapeInterface {
	protected $side_number = 5;
}