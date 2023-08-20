<?php


namespace Gturpin\TainixChallenges\Challenges\MONSTERS_2;

/**
 * An enum of different type of food that can be eaten by a monster
 */
enum FoodType: string {
	case GRASS  = 'G';
	case ROCKS  = 'R';
	case WOOD   = 'W';
	case FRUITS = 'F';
}