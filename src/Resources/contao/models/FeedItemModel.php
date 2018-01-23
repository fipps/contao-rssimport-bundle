<?php
/**
 * xRssImport
 *
 * Copyright (c) 2011, 2014, 2015 agentur fipps e.K
 *
 * @copyright 2011, 2014, 2015 agentur fipps e.K.
 * @author Arne Borchert
 * @package fipps\rssImport
 * @license LGPL
 */
namespace Fipps\RssimportBundle;

/**
 * Class FeedItemModel
 */
class FeedItemModel
{

    public $sLink;

    public $sTitle;

    public $sDescription;

    public $sContent;

    public $sGuid;

    public $iPublished;

    public $iUpdated;

    public $sContributorName;

    public $sAuthorName;

    public $sRights;

    public $arCategoryLabels;

    public $oImage;

    public $oDownload;

    public $arrEnclosures;

    public $sComments;

    public $sCopyright;

    public $sSource;
}
