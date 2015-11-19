<?php
namespace Qinx\Qxanz\Service;

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
 * SessionService
 */
class Session implements \TYPO3\CMS\Core\SingletonInterface {

	/**
	 * Key for storing data in session
	 */
	protected $key;

	/**
	 * Object for storing data
	 */
	protected $storage;

	/**
	 * Class constructor
	 *
	 * @return \Qinx\Qxanz\Service\Session
	 */
	public function __construct() {
		$this->key			= md5(__CLASS__);
		$this->storage 	= $this->getStorageObject()->getKey('ses', $this->key);

		if($this->storage === null) {
			$this->storage = array();
		}
	}

	/**
	 * Returns the storing object, normaly feUser
	 *
	 * @return object
	 */
	protected function getStorageObject() {
		return $GLOBALS['TSFE']->fe_user;
	}

	/**
	 * Store data in Session
	 *
	 * @return void
	 */
	protected function store() {
		$this->getStorageObject()->setKey('ses', $this->key, $this->storage);
		$this->getStorageObject()->storeSessionData();
	}

	/**
	 * Save data in session
	 *
	 * @param string $key
	 * @param mixed $value
	 */
	public function set($key, $value) {
		if(gettype($value) === 'array' || gettype($value) === 'object') {
			$value = serialize($value);
		}

		$this->storage[$key] = $value;
		$this->store();
	}

	/**
	 * Get data from session
	 *
	 * @param string $key
	 * @param mixed $default
	 */
	public function get($key, $default = null) {
		if($this->has($key) === false) {
			return $default;
		}

		$value = $this->storage[$key];

		$unserialized = unserialize($value);
		if(gettype($unserialized) === 'array' || gettype($unserialized) === 'object') {
			return $unserialized;
		}

		return $value;
	}

	/**
	 * Check if a key exists in session
	 *
	 * @param string $key
	 * @return boolean
	 */
	public function has($key) {
		return isset($this->storage[$key]);
	}
}