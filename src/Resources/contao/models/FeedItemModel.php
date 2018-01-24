<?php
/**
 * Contao RSS Import Bundle
 *
 * @copyright 2011, 2014, 2018 agentur fipps e.K.
 * @author    Arne Borchert
 * @package   fipps\contao-rssimport-bundle
 * @license   LGPL 3.0+
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
