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
 * GameController
 */
class GameController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * Action Index
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('games', $this->objectManager->get('\Qinx\Qxanz\Domain\Repository\GameRepository')->findAll());
	}

	/**
	 * Action Create
	 *
	 * @param \Qinx\Qxanz\Domain\Model\Game $game
	 * @ignorevalidation $game
	 * @return void
	 */
	public function createAction(\Qinx\Qxanz\Domain\Model\Game $game = null) {
		$this->view->assign('game', $game);
	}

	/**
	 * Action Save
	 *
	 * @param \Qinx\Qxanz\Domain\Model\Game $game
	 * @param array $settings
	 * @return void
	 */
	public function saveAction(\Qinx\Qxanz\Domain\Model\Game $game, $settings = array()) {
		$this->objectManager->get('\Qinx\Qxanz\Domain\Repository\GameRepository')->save($game);

		// Einstellungen verarbeiten
		if(isset($settings['player']) === true) {
			for($i = 0; $i < (int) $settings['player']; $i++) {
				$player = new \Qinx\Qxanz\Domain\Model\Player();
				$player->setGame($game);

				$this->objectManager->get('\Qinx\Qxanz\Domain\Repository\PlayerRepository')->save($player);
			}
		}

		$this->addFlashMessage(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('game.message.create', 'Qxanz'));
		$this->redirect('index');
	}

	/**
	 * Action Remove
	 *
	 * @param \Qinx\Qxanz\Domain\Model\Game $game
	 * @return void
	 */
	public function removeAction(\Qinx\Qxanz\Domain\Model\Game $game) {
		$this->addFlashMessage(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('game.message.remove', 'Qxanz'));
		$this->objectManager->get('\Qinx\Qxanz\Domain\Repository\GameRepository')->remove($game);
		$this->redirect('index');
	}
}