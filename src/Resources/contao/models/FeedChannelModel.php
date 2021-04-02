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
 * Class FeedChannelModel
 * read a Rss/Atom feed channel
 *
 * @author Arne Borchert, Nikolaus Dulgeridis
 */
class FeedChannelModel
{

    public $sTitle;

    public $sDescription;

    public $iUpdated;

    public $sAuthorName;

    public $arItems = array();

    public $sError;

    /**
     * getFeed
     *
     * @param string $sUrl
     * @return boolean
     */
    public function getFeed($sUrl)
    {
        $oSimplePie = new \SimplePie();
        $oSimplePie->set_feed_url($sUrl);
        $oSimplePie->force_feed(true);

        // Simple Pie: Html-Attribut class erlauben
        $aAttributes = $oSimplePie->strip_attributes;
        $key         = array_search('class', $aAttributes);
        unset($aAttributes[$key]);
        $oSimplePie->strip_attributes($aAttributes);

        // simplePie Konfiguration Contao spezifisch
        $oSimplePie->set_output_encoding($GLOBALS['TL_CONFIG']['characterSet']);
        $oSimplePie->set_cache_location(TL_ROOT.'/system/tmp');
        $oSimplePie->enable_cache(false);

        if (!$oSimplePie->init()) {
            $this->sError = 'fail:'.$oSimplePie->error(); // kein Ergebnis

            return false;
        }
        $oSimplePie->handle_content_type();

        $this->sTitle       = $oSimplePie->get_title();
        $this->sDescription = $oSimplePie->get_description();

        // Add updated
        if ($arUpdated = $oSimplePie->get_feed_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'updated')) {
            $oDate    = new \DateTime($arUpdated[0]['data']);
            $this->id = $oDate->format('U');
        }

        // Add author
        if ($oSimplePie->get_author()->name) {
            $this->sAuthorName = $oSimplePie->get_author()->name;
        }

        // parse items
        $arSimplePieItems = $oSimplePie->get_items();
        for ($i = 0; $i < count($arSimplePieItems); $i++) {
            $oRssFeedItem         = new FeedItemModel();
            $oRssFeedItem->sLink  = $arSimplePieItems[$i]->get_link();
            $oRssFeedItem->sTitle = $arSimplePieItems[$i]->get_title();

            // $oRssFeedItem->sDescription = $arSimplePieItems[$i]->get_description();
            // $oRssFeedItem->sContent = $arSimplePieItems[$i]->get_content();
            // Issue #25: CDATA bei description oder content (https://gitlab.fipps.de/contao/rssImport/issues/25)
            // Dank an Micha Heigl
            if (($arDescr = $arSimplePieItems[$i]->get_item_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'description')) || ($arDescr = $arSimplePieItems[$i]->get_item_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'description'))) {
                $oRssFeedItem->sDescription = $arDescr[0]['data'];
            }
            if (($arContent = $arSimplePieItems[$i]->get_item_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'content')) || ($arContent = $arSimplePieItems[$i]->get_item_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'content'))) {
                $oRssFeedItem->sContent = $arContent[0]['data'];
            }

            $oRssFeedItem->sGuid = $arSimplePieItems[$i]->get_id();

            $arCategories = $arSimplePieItems[$i]->get_categories();
            if (null !== $arCategories) {
                for ($j = 0; $j < count($arCategories); $j++) {
                    $oRssFeedItem->arCategoryLabels[$j] = $arCategories[$j]->get_label();
                }
            }

            $oRssFeedItem->sCopyright = $arSimplePieItems[$i]->get_copyright();

            // get source tag
            if (($arSource = $arSimplePieItems[$i]->get_item_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'source')) || ($arSource = $arSimplePieItems[$i]->get_item_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'source'))) {
                $oRssFeedItem->sSource = $arSource[0]['data'];
            }

            // Add date
            $oRssFeedItem->iPublished = $arSimplePieItems[$i]->get_date('U');
            if ($arUpdated = $arSimplePieItems[$i]->get_item_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'updated')) {
                $oDate                  = new \DateTime($arUpdated[0]['data']);
                $oRssFeedItem->iUpdated = (int)$oDate->format('U');
            } else {
                $oRssFeedItem->iUpdated = $oRssFeedItem->iPublished;
            }

            // Add contributor
            if ($arSimplePieItems[$i]->get_contributor()) {
                $oRssFeedItem->sContributorName = $arSimplePieItems[$i]->get_contributor()->name;
            }

            // Add author
            if ($arSimplePieItems[$i]->get_author()) {
                $oRssFeedItem->sAuthorName = $arSimplePieItems[$i]->get_author()->name;
            }

            // Add enclosure
            $arEnclosures    = $arSimplePieItems[$i]->get_enclosures();
            $aTempEnclosures = array();

            // Process non-standard enclosures
            if ($enclosure = $arSimplePieItems[$i]->get_item_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'enclosure') && !empty($enclosure[0]['attribs']['']['url'])) {
                $url = $arSimplePieItems[$i]->sanitize($enclosure[0]['attribs']['']['url'], SIMPLEPIE_CONSTRUCT_IRI, $arSimplePieItems[$i]->get_base($enclosure[0]));

                if (!empty($enclosure[0]['attribs']['']['type'])) {
                    $type = $arSimplePieItems[$i]->sanitize($enclosure[0]['attribs']['']['type'], SIMPLEPIE_CONSTRUCT_TEXT);
                }

                if (!empty($enclosure[0]['attribs']['']['length'])) {
                    $length = ceil($enclosure[0]['attribs']['']['length']);
                }

                $arEnclosures[] = new \SimplePie_Enclosure($url, $type, $length);
            }

            $imgAlreadySet = false;
            foreach ($arEnclosures as $oEnclosure) {

                if ($oEnclosure->get_link()) {
                    if (!$sType = $oEnclosure->get_type()) {
                        if (!$sType = $oEnclosure->get_medium()) {
                            $sType = "download";
                        }
                    }


                    if (strpos(strtolower($sType), 'image') !== false) {
                        $sType = "image";
                    } else {
                        $sType = "download";
                    }


                    $oItemEnclosure               = new FeedEnclosureModel();
                    $oItemEnclosure->sLink        = $oEnclosure->get_link();
                    $oItemEnclosure->sTitle       = $oEnclosure->get_title();
                    $oItemEnclosure->sDescription = $oEnclosure->get_description();
                    $oItemEnclosure->iLength      = $oEnclosure->get_length();
                    $oItemEnclosure->iWidth       = $oEnclosure->get_width();
                    $oItemEnclosure->iHeight      = $oEnclosure->get_height();
                    $oItemEnclosure->sType        = $sType;

                    // Nur das erste Bild als Bild einbinden
                    if ($sType == "image" && !$imgAlreadySet) {
                        $oRssFeedItem->oImage = $oItemEnclosure;
                        $imgAlreadySet        = true;
                    }

                    $aTempEnclosures[] = $oItemEnclosure;
                } // endif
                // $oEnclosure = $arSimplePieItems[$i]->get_enclosure($k++);
            }

            $oRssFeedItem->arrEnclosures = $aTempEnclosures;
            $this->arItems[]             = $oRssFeedItem;
        } // endfor

        return true; // Feed erfolgreich gelesen
    }
}
