<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'Qinx.' . $_EXTKEY,
	'Pi1',
	'Qinx Antz'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Qinx Anz');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_qxanz_domain_model_game', 'EXT:qxanz/Resources/Private/Language/locallang_csh_tx_qxanz_domain_model_game.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_qxanz_domain_model_game');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_qxanz_domain_model_colony', 'EXT:qxanz/Resources/Private/Language/locallang_csh_tx_qxanz_domain_model_colony.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_qxanz_domain_model_colony');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_qxanz_domain_model_player', 'EXT:qxanz/Resources/Private/Language/locallang_csh_tx_qxanz_domain_model_player.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_qxanz_domain_model_player');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_qxanz_domain_model_systembuilding', 'EXT:qxanz/Resources/Private/Language/locallang_csh_tx_qxanz_domain_model_systembuilding.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_qxanz_domain_model_systembuilding');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_qxanz_domain_model_building', 'EXT:qxanz/Resources/Private/Language/locallang_csh_tx_qxanz_domain_model_building.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_qxanz_domain_model_building');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_qxanz_domain_model_playerattributes', 'EXT:qxanz/Resources/Private/Language/locallang_csh_tx_qxanz_domain_model_playerattributes.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_qxanz_domain_model_playerattributes');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_qxanz_domain_model_systemresources', 'EXT:qxanz/Resources/Private/Language/locallang_csh_tx_qxanz_domain_model_systemresources.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_qxanz_domain_model_systemresources');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_qxanz_domain_model_resources', 'EXT:qxanz/Resources/Private/Language/locallang_csh_tx_qxanz_domain_model_resources.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_qxanz_domain_model_resources');
