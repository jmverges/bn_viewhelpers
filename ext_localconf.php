<?php
defined('TYPO3_MODE') or die();

if (!isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['bn'])) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['bn'] = [];
}

$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['bn'][] = 'BusyNoggin\\BnViewhelpers\\ViewHelpers';