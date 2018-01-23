<?php
namespace Fipps\RssimportBundle;

use Contao\Backend;
/**
 * xRssImport3
 *
 * Copyright (c) 2011, 2014 agentur fipps e.K
 *
 * @copyright 2011, 2014 agentur fipps e.K.
 * @author Arne Borchert
 * @package fipps\rssImport
 * @license LGPL
 */

// Initialize Backend
if (!defined('TL_MODE')) {
    define('TL_MODE', 'BE');
    define('TL_SCRIPT', 'contao/install.php'); // Workaround for FontAwesome Extension

    $dir = __DIR__;
    while (($dir != '.') && ($dir != '/') && !is_file($dir . '/system/initialize.php')) {
        $dir = dirname($dir);
    }

    if (!is_file($dir . '/system/initialize.php')) {
        die("Could not find initialize.php");
    }

    require ($dir . '/system/initialize.php');
}

/**
 * Class AutoImportNews
 */
class AutoImportNews extends Backend
{

    public function __construct()
    {
        parent::__construct();
    }

    public function run()
    {
        $rssImport = new RssImport3();
        $this->log('AutoImport NewsFeeds', 'AutoImportNews->run', TL_GENERAL);
        $rssImport->importAllNewsFeeds();
    }
}