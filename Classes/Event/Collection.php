<?php
namespace Qinx\Qxanz\Event;

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
 * Event
 */
class Collection implements \Countable, \Iterator, \ArrayAccess {

	/**
	 * internal storage array
	 *
	 * @var array
	 */
	protected $storage = [];

	/**
	 * reset the pointer to first element
	 *
	 * @return void
	 */
	public function rewind() {
		reset($this->storage);
	}

	/**
	 * Checks if the array pointer of the storage points to a valid position.
	 *
	 * @return boolean
	 */
	public function valid() {
		return current($this->storage) !== false;
	}

	/**
	 * Returns the index at which the iterator currently is.
	 *
	 * This is different from the SplObjectStorage as the key in this implementation is the object hash (string).
	 *
	 * @return string The index corresponding to the position of the iterator.
	 */
	public function key() {
		return key($this->storage);
	}

	/**
	 * Returns the current storage entry.
	 *
	 * @return object The object at the current iterator position.
	 */
	public function current() {
		$item = current($this->storage);
		return $item['obj'];
	}

	/**
	 * Moves to the next entry.
	 *
	 * @return void
	 */
	public function next() {
		next($this->storage);
	}

	/**
	 * Returns the number of objects in the storage.
	 *
	 * @return integer The number of objects in the storage.
	 */
	public function count() {
		return count($this->storage);
	}

	/**
	 * Associates data to an object in the storage. offsetSet() is an alias of attach().
	 *
	 * @param object $object The object to add.
	 * @param mixed $information The data to associate with the object.
	 * @return void
	 */
	public function offsetSet($object, $information) {
		$this->isModified = true;
		$this->storage[spl_object_hash($object)] = array('obj' => $object, 'inf' => $information);

		$this->positionCounter++;
		$this->addedObjectsPositions[spl_object_hash($object)] = $this->positionCounter;
	}

	/**
	 * Checks whether an object exists in the storage.
	 *
	 * @param object $object The object to look for.
	 * @return boolean
	 */
	public function offsetExists($object) {
		return is_object($object) && isset($this->storage[spl_object_hash($object)]);
	}

	/**
	 * Removes an object from the storage. offsetUnset() is an alias of detach().
	 *
	 * @param object $object The object to remove.
	 * @return void
	 */
	public function offsetUnset($object) {
		$this->isModified = true;
		unset($this->storage[spl_object_hash($object)]);

		if(empty($this->storage)) {
			$this->positionCounter = 0;
		}

		$this->removedObjectsPositions[spl_object_hash($object)] = $this->addedObjectsPositions[spl_object_hash($object)];
		unset($this->addedObjectsPositions[spl_object_hash($object)]);
	}

	/**
	 * Returns the data associated with an object.
	 *
	 * @param object $object The object to look for.
	 * @return mixed The data associated with an object in the storage.
	 */
	public function offsetGet($object) {
		return $this->storage[spl_object_hash($object)]['inf'];
	}

	/**
	 * Checks if the storage contains a specific object.
	 *
	 * @param object $object The object to look for.
	 * @return boolean
	 */
	public function contains($object) {
		return $this->offsetExists($object);
	}
}