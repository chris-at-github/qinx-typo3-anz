<?php
namespace Qinx\Qxanz\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Christian Pschorr <pschorr.christian@gmail.com>
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Qinx\Qxanz\Controller\GameController.
 *
 * @author Christian Pschorr <pschorr.christian@gmail.com>
 */
class GameControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Qinx\Qxanz\Controller\GameController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Qinx\\Qxanz\\Controller\\GameController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllGamesFromRepositoryAndAssignsThemToView() {

		$allGames = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$gameRepository = $this->getMock('Qinx\\Qxanz\\Domain\\Repository\\GameRepository', array('findAll'), array(), '', FALSE);
		$gameRepository->expects($this->once())->method('findAll')->will($this->returnValue($allGames));
		$this->inject($this->subject, 'gameRepository', $gameRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('games', $allGames);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenGameToView() {
		$game = new \Qinx\Qxanz\Domain\Model\Game();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('game', $game);

		$this->subject->showAction($game);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenGameToView() {
		$game = new \Qinx\Qxanz\Domain\Model\Game();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newGame', $game);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($game);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenGameToGameRepository() {
		$game = new \Qinx\Qxanz\Domain\Model\Game();

		$gameRepository = $this->getMock('Qinx\\Qxanz\\Domain\\Repository\\GameRepository', array('add'), array(), '', FALSE);
		$gameRepository->expects($this->once())->method('add')->with($game);
		$this->inject($this->subject, 'gameRepository', $gameRepository);

		$this->subject->createAction($game);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenGameToView() {
		$game = new \Qinx\Qxanz\Domain\Model\Game();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('game', $game);

		$this->subject->editAction($game);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenGameInGameRepository() {
		$game = new \Qinx\Qxanz\Domain\Model\Game();

		$gameRepository = $this->getMock('Qinx\\Qxanz\\Domain\\Repository\\GameRepository', array('update'), array(), '', FALSE);
		$gameRepository->expects($this->once())->method('update')->with($game);
		$this->inject($this->subject, 'gameRepository', $gameRepository);

		$this->subject->updateAction($game);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenGameFromGameRepository() {
		$game = new \Qinx\Qxanz\Domain\Model\Game();

		$gameRepository = $this->getMock('Qinx\\Qxanz\\Domain\\Repository\\GameRepository', array('remove'), array(), '', FALSE);
		$gameRepository->expects($this->once())->method('remove')->with($game);
		$this->inject($this->subject, 'gameRepository', $gameRepository);

		$this->subject->deleteAction($game);
	}
}
