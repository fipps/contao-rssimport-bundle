<?php
/**
 * rssImport
 *
 * Copyright (c) 2011, 2014, 2015 agentur fipps e.K
 *
 * @copyright 2011, 2014, 2015 agentur fipps e.K.
 * @author Arne Borchert
 * @package fipps\rssImport
 * @license LGPL
 */
$GLOBALS['TL_CRON']['hourly'][] = array(
        'Fipps\RssimportBundle\AutoImportNews',
        'run'
);