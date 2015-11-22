<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Qinx.' . $_EXTKEY,
	'Pi1',
	array(
		'Game' => 'index, create, save',
		'Playground' => 'index, base, activatePlayer',
	),
	// non-cacheable actions
	array(
		'Game' => 'index, save',
		'Playground' => '',
	)
);
