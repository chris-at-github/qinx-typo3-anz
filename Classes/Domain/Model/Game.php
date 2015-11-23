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
 * Game
 */
class Game extends Application {

	/**
	 * title
	 * 
	 * @var string
	 */
	protected $title = '';

	/**
	 * turn
	 * 
	 * @var integer
	 */
	protected $turn = 0;

	/**
	 * player of this game
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	protected $players;

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
	 * Returns the turn
	 * 
	 * @return integer $turn
	 */
	public function getTurn() {
		return $this->turn;
	}

	/**
	 * Sets the turn
	 * 
	 * @param integer $turn
	 * @return void
	 */
	public function setTurn($turn) {
		$this->turn = $turn;
	}

	/**
	 * Return the active player (if is set in session)
	 *
	 * @return \Qinx\Qxanz\Domain\Model\
	 */
	public function getPlayer() {
		$session = $this->getObjectManager()->get('\Qinx\Qxanz\Service\Session'); /* @var \Qinx\Qxanz\Service\Session $session */

		if($session->has('player') === true) {
			return $this->getObjectManager()->get('\Qinx\Qxanz\Domain\Repository\PlayerRepository')->findByUid($session->get('player'));
		}

		return null;
	}

	/**
	 * Returns all players
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	public function getPlayers() {
		if(isset($this->players) === false) {
			$this->players = $this->getObjectManager()->get('\Qinx\Qxanz\Domain\Repository\PlayerRepository')->findAll([
				'game' => $this
			]);
		}

		return $this->players;
	}
}