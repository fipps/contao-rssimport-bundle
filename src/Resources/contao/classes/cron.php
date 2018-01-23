<?php

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

require('AutoImportNews.php');
$autoImport = new AutoImportNews();
$autoImport->run();