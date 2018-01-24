<?php
/**
 * Contao RSS Import Bundle
 *
 * @copyright 2011, 2014, 2018 agentur fipps e.K.
 * @author    Arne Borchert
 * @package   fipps\contao-rssimport-bundle
 * @license   LGPL 3.0+
 */

$GLOBALS['TL_CRON']['hourly'][] = array(
    'Fipps\RssimportBundle\AutoImportNews',
    'run',
);