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
 * Resources
 */
class Resources extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * value
     * 
     * @var float
     */
    protected $value = 0.0;
    
    /**
     * player
     * 
     * @var \Qinx\Qxanz\Domain\Model\Player
     * @lazy
     */
    protected $player = null;
    
    /**
     * system
     * 
     * @var \Qinx\Qxanz\Domain\Model\SystemResources
     */
    protected $system = null;
    
    /**
     * Returns the value
     * 
     * @return float $value
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * Sets the value
     * 
     * @param float $value
     * @return void
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
    
    /**
     * Returns the player
     * 
     * @return \Qinx\Qxanz\Domain\Model\Player $player
     */
    public function getPlayer()
    {
        return $this->player;
    }
    
    /**
     * Sets the player
     * 
     * @param \Qinx\Qxanz\Domain\Model\Player $player
     * @return void
     */
    public function setPlayer(\Qinx\Qxanz\Domain\Model\Player $player)
    {
        $this->player = $player;
    }
    
    /**
     * Returns the system
     * 
     * @return \Qinx\Qxanz\Domain\Model\SystemResources $system
     */
    public function getSystem()
    {
        return $this->system;
    }
    
    /**
     * Sets the system
     * 
     * @param \Qinx\Qxanz\Domain\Model\SystemResources $system
     * @return void
     */
    public function setSystem(\Qinx\Qxanz\Domain\Model\SystemResources $system)
    {
        $this->system = $system;
    }

}