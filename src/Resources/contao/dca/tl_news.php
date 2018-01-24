<?php
/**
 * Contao RSS Import Bundle
 *
 * @copyright 2011, 2014, 2018 agentur fipps e.K.
 * @author    Arne Borchert
 * @package   fipps\contao-rssimport-bundle
 * @license   LGPL 3.0+
 */

// Table tl_news
$GLOBALS['TL_DCA']['tl_news']['config']['ondelete_callback'][] = array(
    'Fipps\RssimportBundle\RssImport',
    'deleteAttachments',
);
$GLOBALS['TL_DCA']['tl_news']['config']['onload_callback'][]   = array(
    'Fipps\RssimportBundle\RssImport',
    'importNewFeeds',
);

// Fields
$tmpfields = array(
    'rssimp_guid' => array(
        'sql' => "mediumtext NULL",
    ),
    'rssimp_link' => array(
        'sql' => "mediumtext NULL",
    ),
);

$GLOBALS['TL_DCA']['tl_news']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_news']['fields'], $tmpfields);