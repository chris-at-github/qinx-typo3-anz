<?php
namespace Qinx\Qxanz\ViewHelpers;

	/*                                                                        *
	 * This script is backported from the TYPO3 Flow package "TYPO3.Fluid".   *
	 *                                                                        *
	 * It is free software; you can redistribute it and/or modify it under    *
	 * the terms of the GNU Lesser General Public License, either version 3   *
	 *  of the License, or (at your option) any later version.                *
	 *                                                                        *
	 *                                                                        *
	 * This script is distributed in the hope that it will be useful, but     *
	 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
	 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
	 * General Public License for more details.                               *
	 *                                                                        *
	 * You should have received a copy of the GNU Lesser General Public       *
	 * License along with the script.                                         *
	 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
	 *                                                                        *
	 * The TYPO3 project - inspiring people to share!                         *
	 *                                                                        */
/**
 * View helper which renders the flash messages (if there are any) as an unsorted list.
 *
 * In case you need custom Flash Message HTML output, please write your own ViewHelper for the moment.
 *
 *
 * = Examples =
 *
 * <code title="Simple">
 * <f:flashMessages />
 * </code>
 * <output>
 * An ul-list of flash messages.
 * </output>
 *
 * <code title="Output with custom css class">
 * <f:flashMessages class="specialClass" />
 * </code>
 * <output>
 * <ul class="specialClass">
 * ...
 * </ul>
 * </output>
 *
 * <code title="TYPO3 core style">
 * <f:flashMessages renderMode="div" />
 * </code>
 * <output>
 * <div class="typo3-messages">
 * <div class="typo3-message message-ok">
 * <div class="message-header">Some Message Header</div>
 * <div class="message-body">Some message body</div>
 * </div>
 * <div class="typo3-message message-notice">
 * <div class="message-body">Some notice message without header</div>
 * </div>
 * </div>
 * </output>
 *
 * @api
 */
class FlashMessagesViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\FlashMessagesViewHelper {

	/**
	 * Renders the flash messages as unordered list
	 *
	 * @param array $flashMessages array<\TYPO3\CMS\Core\Messaging\FlashMessage>
	 * @return string
	 */
	protected function renderUl(array $flashMessages) {
		$this->tag->setTagName('div');

		$tagContent = [];
		$tagClasses	= ['message'];

		/* @var $singleFlashMessage \TYPO3\CMS\Core\Messaging\FlashMessage */
		foreach($flashMessages as $singleFlashMessage) {
			$tagContent[] = '<li>' . htmlspecialchars($singleFlashMessage->getMessage()) . '</li>';
			$tagClasses[] = $singleFlashMessage->getClass();
		}

		if($this->hasArgument('class')) {
			$tagClasses[] = $this->hasArgument('class');
		}

		$tagContent = '<ul>' . implode(null, $tagContent) . '</ul>';
		$tagClasses	= implode(' ', array_unique($tagClasses));

		$this->tag->setContent($tagContent);
		$this->tag->addAttribute('class', $tagClasses);

		return $this->tag->render();
	}
}
