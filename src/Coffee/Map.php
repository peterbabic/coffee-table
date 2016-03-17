<?php

namespace Coffee;

use Exception;

/**
 * Class Map
 *
 * @package Coffee
 */
class Map {
	/**
	 * @var array
	 */
	private $description = [];

	/**
	 * @var array
	 */
	private $visited = [];

	/**
	 * @var int
	 */
	private $height = 0;

	/**
	 * @var int
	 */
	private $width = 0;

	/**
	 * Map constructor.
	 *
	 * @param $description
	 * @throws Exception
	 */
	public function __construct($description) {
		if (is_null($description) || !is_array($description) || !is_array($description[0])) {
			throw new Exception('The Coffee Table map could not be loaded.');
		}

		$this->width = $this->calculateMapWidth($description);
		$this->height = $this->calculateMapHeight($description);

		$this->description = $description;
	}

	/**
	 * @return array
	 */
	public function describedByArray() {
		return $this->description;
	}

	/**
	 * @param Position $position
	 * @return bool
	 */
	public function visitPosition(Position $position) {
		if ($this->isValidPosition($position)) {
			$this->visited[$position->getRow()][$position->getColumn()] = true;
			return true;
		}

		return false;
	}

	/**
	 * @param Position $position
	 * @return bool
	 */
	public function isValidPosition(Position $position) {
		if ($position->getRow() < 0 || $position->getColumn() < 0) {
			return false;
		}

		// Map dimensions start from 1 but row/col positions start from 0, need to compensate
		if ($position->getRow() >= $this->getHeight() || $position->getColumn() >= $this->getWidth()) {
			return false;
		}

		return true;
	}

	/**
	 * @return int
	 */
	public function getHeight() {
		return $this->height;
	}

	/**
	 * @return int
	 */
	public function getWidth() {
		return $this->width;
	}

	/**
	 * @param $position
	 * @return bool
	 */
	public function isVisitedPosition(Position $position) {
		if (!isset($this->visited[$position->getRow()][$position->getColumn()])) {
			return false;
		}

		return ($this->visited[$position->getRow()][$position->getColumn()] == true);
	}

	/**
	 * @param $description
	 * @return int
	 */
	private function calculateMapWidth($description) {
		$widestRow = 0;
		foreach ($description as $row) {
			// Count the level 2 array elements
			$colWidth = count($row);

			if ($colWidth > $widestRow) {
				$widestRow = $colWidth;
			}
		}
		return $widestRow;
	}

	/**
	 * @param $description
	 * @return int
	 */
	private function calculateMapHeight($description) {
		// Count the level 1 array elements
		return count($description);
	}

}