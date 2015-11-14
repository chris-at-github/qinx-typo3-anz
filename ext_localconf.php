<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Qinx.' . $_EXTKEY,
	'Pi1',
	array(
		'Game' => 'list, show, new, create, edit, update, delete, index, playground',
		
	),
	// non-cacheable actions
	array(
		'Game' => 'create, update, delete, ',
		
	)
);
