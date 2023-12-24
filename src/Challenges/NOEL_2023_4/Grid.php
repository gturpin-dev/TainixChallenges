<?php

namespace Gturpin\TainixChallenges\Challenges\NOEL_2023_4;

use Gturpin\TainixChallenges\Challenges\NOEL_2023_4\OutOfBoundsException;

/**
 * a grid is defined by columns and rows of one digit
 * The grid must be able to know a value of a number at a given position
 */
class Grid {
    /**
     * The grid data like array of rows containing array of columns
     */
    protected array $data;

    /**
     * @param array<string> $data The grid data like array of rows containing string
     */
    public function __construct(
		protected readonly int $max_rows,
		protected readonly int $max_columns,
	) {
        $this->data = array_fill( 0, $this->max_rows, array_fill( 0, $this->max_columns, null ) );
    }

    /**
     * Get a specific cell value
     *
     * @param  Position $position The position of the cell
     * @return string   The cell value
     *
     * @throws OutOfBoundsException If the cell is out of bounds
     */
    public function get_cell( Position $position ) : string {
        if ( ! isset( $this->data[$position->y] ) || ! isset( $this->data[$position->y][$position->x] ) ) {
            throw new OutOfBoundsException( sprintf( 'The cell (%d,%d) is out of bounds', $position->x, $position->y ) );
        }

        return $this->data[$position->y][$position->x];
    }

	public function get_width() : int {
		return $this->max_columns;
	}

	public function get_height() : int {
		return $this->max_rows;
	}
}