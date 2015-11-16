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




//	/**
//	 * action list
//	 *
//	 * @return void
//	 */
//	public function listAction() {
//		$games = $this->gameRepository->findAll();
//		$this->view->assign('games', $games);
//	}
//
//	/**
//	 * action show
//	 *
//	 * @param \Qinx\Qxanz\Domain\Model\Game $game
//	 * @return void
//	 */
//	public function showAction(\Qinx\Qxanz\Domain\Model\Game $game) {
//		$this->view->assign('game', $game);
//	}
//
//	/**
//	 * action new
//	 *
//	 * @param \Qinx\Qxanz\Domain\Model\Game $newGame
//	 * @ignorevalidation $newGame
//	 * @return void
//	 */
//	public function newAction(\Qinx\Qxanz\Domain\Model\Game $newGame = NULL) {
//		$this->view->assign('newGame', $newGame);
//	}
//
//	/**
//	 * action create
//	 *
//	 * @param \Qinx\Qxanz\Domain\Model\Game $newGame
//	 * @return void
//	 */
//	public function createAction(\Qinx\Qxanz\Domain\Model\Game $newGame) {
//		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
//		$this->gameRepository->add($newGame);
//		$this->redirect('list');
//	}
//
//	/**
//	 * action edit
//	 *
//	 * @param \Qinx\Qxanz\Domain\Model\Game $game
//	 * @ignorevalidation $game
//	 * @return void
//	 */
//	public function editAction(\Qinx\Qxanz\Domain\Model\Game $game) {
//		$this->view->assign('game', $game);
//	}
//
//	/**
//	 * action update
//	 *
//	 * @param \Qinx\Qxanz\Domain\Model\Game $game
//	 * @return void
//	 */
//	public function updateAction(\Qinx\Qxanz\Domain\Model\Game $game) {
//		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
//		$this->gameRepository->update($game);
//		$this->redirect('list');
//	}
//
//	/**
//	 * action delete
//	 *
//	 * @param \Qinx\Qxanz\Domain\Model\Game $game
//	 * @return void
//	 */
//	public function deleteAction(\Qinx\Qxanz\Domain\Model\Game $game) {
//		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
//		$this->gameRepository->remove($game);
//		$this->redirect('list');
//	}
}