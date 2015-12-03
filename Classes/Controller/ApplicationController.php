<?php
namespace Qinx\Qxanz\Controller;

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
 * ApplicationController
 */
class ApplicationController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * Session service class
	 *
	 * @var \Qinx\Qxanz\Service\Session
	 */
	protected $session;

	/**
	 * Game model class
	 *
	 * @var \Qinx\Qxanz\Domain\Model\Game
	 */
	protected $game;

	/**
	 * Player model class
	 *
	 * @var \Qinx\Qxanz\Domain\Model\Player
	 */
	protected $player;

	/**
	 * Initializes the controller before invoking an action method. Use to set the session service for all controllers.
	 *
	 * @return void
	 * @api
	 */
	protected function initializeAction() {
		parent::initializeAction();

		$this->session = $this->objectManager->get('\Qinx\Qxanz\Service\Session');
	}

	/**
	 * Initializes the view before invoking an action method.
	 *
	 * Override this method to solve assign variables common for all actions
	 * or prepare the view in another way before the action is called.
	 *
	 * @param \TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view The view to be initialized
	 *
	 * @return void
	 * @api
	 */
	protected function initializeView(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view) {
		parent::initializeView($view);

		$this->view->assign('game', $this->getGame());
	}

	/**
	 * Returns the current game
	 *
	 * @return \Qinx\Qxanz\Domain\Model\Game
	 */
	public function getGame() {
		if($this->game === null && $this->session->has('game') === true) {
			$this->game = $this->objectManager->get('\Qinx\Qxanz\Domain\Repository\GameRepository')->findByUid($this->session->get('game'));
		}

		return $this->game;
	}

	/**
	 * Returns the current active player
	 *
	 * @return \Qinx\Qxanz\Domain\Model\Player
	 */
	public function getPlayer() {
		if($this->player === null && $this->session->has('player') === true) {
			$this->player = $this->objectManager->get('\Qinx\Qxanz\Domain\Repository\PlayerRepository')->findByUid($this->session->get('player'));
		}

		return $this->player;
	}
}