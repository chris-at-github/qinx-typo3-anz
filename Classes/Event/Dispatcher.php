<?php
namespace Qinx\Qxanz\Event;

/**
 * Event/Dispatcher
 */
class Dispatcher {

	/**
	 * objectManager
	 *
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager
	 */
	protected $objectManager;

	/**
	 * Session service class
	 *
	 * @var \Qinx\Qxanz\Service\Session
	 */
	protected $session;

	/**
	 * Constructor
	 *
	 * @return \Qinx\Qxanz\Event\Dispatcher
	 */
	public function __construct() {
		$this->session = $this->getObjectManager()->get('Qinx\Qxanz\Service\Session');
	}

	/**
	 * return an instance of objectManager
	 *
	 * @param none
	 * @return \TYPO3\CMS\Extbase\Object\ObjectManager
	 */
	public function getObjectManager() {
		if(($this->objectManager instanceof \TYPO3\CMS\Extbase\Object\ObjectManager) === false) {
			$this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
		}

		return $this->objectManager;
	}

	/**
	 * Returns the current active player
	 *
	 * @return \Qinx\Qxanz\Domain\Model\Player
	 */
	public function getPlayer() {
		if($this->session->has('player') === true) {
			return $this->objectManager->get('Qinx\Qxanz\Domain\Repository\PlayerRepository')->findByUid($this->session->get('player'));
		}

		return null;
	}

	/**
	 * dispatch events to the executable event classes
	 *
	 * @param string $name
	 * @param array $options
	 */
	public function dispatch($name, $options = []) {

		$player = $this->getPlayer();
		$events = $this->getObjectManager()->get('Qinx\Qxanz\Domain\Repository\EventRepository')->findAll(['event' => $name]);

		foreach($events as $event) {
			if($event instanceof \Qinx\Qxanz\Event\Player) {
				$player = $event->$name($player);
			}
		}

		$this->objectManager->get('Qinx\Qxanz\Domain\Repository\PlayerRepository')->save($player);
	}
}