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
use Qinx\Qxanz\Domain\Model\Building;

/**
 * ColonyController
 */
class ColonyController extends ApplicationController {

	/**
	 * Index Action
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('player', $this->getPlayer());
		$this->view->assign('buildings', $this->objectManager->get('Qinx\Qxanz\Domain\Repository\BuildingRepository')->findAllBy([
			'player' => $this->getPlayer()
		]));
	}

	/**
	 * Create Action
	 * 
	 * @return void
	 */
	public function createAction() {
		if($this->session->has('player') === false) {
			$this->addFlashMessage('Bitte Player wählen', \TYPO3\CMS\Core\Messaging\AbstractMessage::NOTICE);
			$this->redirect('index', 'Playground');
		}

		$this->view->assign('player', $this->objectManager->get('Qinx\Qxanz\Domain\Repository\PlayerRepository')->findByUid($this->session->get('player')));
	}

	/**
	 * Action Save
	 *
	 * @param \Qinx\Qxanz\Domain\Model\Colony $colony
	 * @return void
	 */
	public function saveAction(\Qinx\Qxanz\Domain\Model\Colony $colony) {
		$this->objectManager->get('Qinx\Qxanz\Domain\Repository\ColonyRepository')->save($colony);
		$this->redirect('index');
	}

	/**
	 * Action Create Building
	 *
	 * @param \Qinx\Qxanz\Domain\Model\Colony $colony
	 * @return void
	 */
	public function createBuildingAction(\Qinx\Qxanz\Domain\Model\Colony $colony) {
		$this->view->assign('buildings', $this->objectManager->get('Qinx\Qxanz\Domain\Repository\SystemBuildingRepository')->findAllBy());
	}

	/**
	 * Action Save Building
	 *
	 * @param \Qinx\Qxanz\Domain\Model\SystemBuilding $systemBuilding
	 * @return void
	 */
	public function saveBuildingAction(\Qinx\Qxanz\Domain\Model\SystemBuilding $systemBuilding) {
		$building = new \Qinx\Qxanz\Domain\Model\Building();
		$building
			->setPlayer($this->getPlayer())
			->setSystem($systemBuilding);

		$this->objectManager->get('Qinx\Qxanz\Domain\Repository\BuildingRepository')->save($building);
		$this->redirect('index');
	}
}