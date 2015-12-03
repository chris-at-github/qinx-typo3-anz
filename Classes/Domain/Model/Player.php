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
 * Player
 */
class Player extends Application {

	/**
	 * title
	 * 
	 * @var string
	 */
	protected $title = '';

	/**
	 * game
	 * 
	 * @var \Qinx\Qxanz\Domain\Model\Game
	 * @lazy
	 */
	protected $game = NULL;

	/**
	 * Returns the title
	 * 
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 * 
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the game
	 * 
	 * @return \Qinx\Qxanz\Domain\Model\Game $game
	 */
	public function getGame() {
		return $this->game;
	}

	/**
	 * Sets the game
	 * 
	 * @param \Qinx\Qxanz\Domain\Model\Game $game
	 * @return void
	 */
	public function setGame(\Qinx\Qxanz\Domain\Model\Game $game) {
		$this->game = $game;
	}

	/**
	 * Returns the players colony
	 *
	 * @return \Qinx\Qxanz\Domain\Model\Colony
	 */
	public function getColony() {
		return $this->getObjectManager()->get('\Qinx\Qxanz\Domain\Repository\ColonyRepository')->findBy(['player' => $this]);
	}
}