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
use Qinx\Qxanz\Domain\Model\Application;

/**
 * PlaygroundController
 */
class PlaygroundController extends ApplicationController {

	/**
	 * Action Index
	 *
	 * @param \Qinx\Qxanz\Domain\Model\Game $game
	 * @return void
	 */
	public function indexAction(\Qinx\Qxanz\Domain\Model\Game $game = null) {
		$session = $this->objectManager->get('Qinx\Qxanz\Service\Session'); /* @var \Qinx\Qxanz\Service\Session $session */

		if($game === null && $session->has('game') === true) {
			$game = $this->objectManager->get('Qinx\Qxanz\Domain\Repository\GameRepository')->findByUid($session->get('game'));

		} elseif($game instanceof \Qinx\Qxanz\Domain\Model\Game) {
			$session->set('game', $game->getUid());
		}

		$this->view->assign('game', $game);
	}

	/**
	 * Action Active Player
	 *
	 * @param \Qinx\Qxanz\Domain\Model\Player $player
	 * @return void
	 */
	public function activatePlayerAction(\Qinx\Qxanz\Domain\Model\Player $player) {
		$session = $this->objectManager->get('Qinx\Qxanz\Service\Session'); /* @var \Qinx\Qxanz\Service\Session $session */

		if($player instanceof \Qinx\Qxanz\Domain\Model\Player) {
			$session->set('player', $player->getUid());
		}

		$this->redirect('index');
	}

	/**
	 * Action Turn End
	 *
	 * @param \Qinx\Qxanz\Domain\Model\Game $game
	 * @return void
	 */
	public function turnEndAction(\Qinx\Qxanz\Domain\Model\Game $game) {

		// Before Turn End
		$player	= $this->getPlayer();
		$events = $this->objectManager->get('Qinx\Qxanz\Domain\Repository\EventRepository')->findAll(['event' => 'onBeforeTurnEnd']);

		foreach($events as $event) {
			if($event instanceof \Qinx\Qxanz\Event\Player) {
				$player = $event->onBeforeTurnEnd($player);
			}
		}

		$this->objectManager->get('Qinx\Qxanz\Domain\Repository\PlayerRepository')->save($player);

		$this->objectManager->get('Qinx\Qxanz\Domain\Repository\GameRepository')->save($game->addTurn());
		$this->redirect('index');
	}
}