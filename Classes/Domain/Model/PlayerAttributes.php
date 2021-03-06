<?php
namespace Qinx\Qxanz\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Christian Pschorr <pschorr.christian@gmail.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * PlayerAttributes
 */
class PlayerAttributes extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * maxPopulation
	 *
	 * @var int
	 */
	protected $maxPopulation = 0;

	/**
	 * maxStorage
	 *
	 * @var float
	 */
	protected $maxStorage = 0.0;

	/**
	 * Returns the maxPopulation
	 *
	 * @return int $maxPopulation
	 */
	public function getMaxPopulation() {
		return $this->maxPopulation;
	}

	/**
	 * Sets the maxPopulation
	 *
	 * @param int $maxPopulation
	 * @return void
	 */
	public function setMaxPopulation($maxPopulation) {
		$this->maxPopulation = $maxPopulation;
	}

	/**
	 * Returns the maxStorage
	 *
	 * @return float $maxStorage
	 */
	public function getMaxStorage() {
		return $this->maxStorage;
	}

	/**
	 * Sets the maxStorage
	 *
	 * @param float $maxStorage
	 * @return void
	 */
	public function setMaxStorage($maxStorage) {
		$this->maxStorage = $maxStorage;
	}

}