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
 * Building
 */
class Building extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * player
	 * 
	 * @var \Qinx\Qxanz\Domain\Model\Player
	 * @lazy
	 */
	protected $player = NULL;

	/**
	 * system
	 * 
	 * @var \Qinx\Qxanz\Domain\Model\SystemBuilding
	 */
	protected $system = NULL;

	/**
	 * Returns the player
	 * 
	 * @return \Qinx\Qxanz\Domain\Model\Player $player
	 */
	public function getPlayer() {
		return $this->player;
	}

	/**
	 * Sets the player
	 * 
	 * @param \Qinx\Qxanz\Domain\Model\Player $player
	 * @return \Qinx\Qxanz\Domain\Model\Building
	 */
	public function setPlayer(\Qinx\Qxanz\Domain\Model\Player $player) {
		$this->player = $player;
		return $this;
	}

	/**
	 * Returns the system
	 * 
	 * @return \Qinx\Qxanz\Domain\Model\SystemBuilding $system
	 */
	public function getSystem() {
		return $this->system;
	}

	/**
	 * Sets the system
	 * 
	 * @param \Qinx\Qxanz\Domain\Model\SystemBuilding $system
	 * @return \Qinx\Qxanz\Domain\Model\Building
	 */
	public function setSystem(\Qinx\Qxanz\Domain\Model\SystemBuilding $system) {
		$this->system = $system;
		return $this;
	}

	/**
	 * Returns the title of the building base on system->title
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->getSystem()->getTitle();
	}
}