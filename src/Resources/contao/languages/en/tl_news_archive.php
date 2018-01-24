<?php
/**
 * Contao RSS Import Bundle
 *
 * @copyright 2011, 2014, 2018 agentur fipps e.K.
 * @author    Arne Borchert
 * @package   fipps\contao-rssimport-bundle
 * @license   LGPL 3.0+
 */

/**
 * Fields
 */

$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_imp']         = array(
    'Import Feed',
    'Import RSS-Feed into the news database.',
);
$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_impurl']      = array(
    'Import Feed Url',
    'Please choose the URL for the Feed to import.',
);
$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_imgpath']     = array(
    'Image/Attachment Path',
    'Please choose a path to store images and attachments.',
);
$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_dlpath']      = array(
    'Download Path',
    'Please choose a path to store downloads.',
);
$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_published']   = array(
    'Publish',
    'Automatically assign imported news as published',
);
$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_teaserhtml']  = array(
    'Allow HTML',
    'Allow HTML-Tags inside the teaser.',
);
$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_subtitlesrc'] = array(
    'Field for subtitles',
    'Define field for subtitles from RSS/Atom-feed.',
);
$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_allowedTags'] = array(
    'Allowed HTML Tags',
    'Defines which html-tags are allowed in the content.',
);
$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_truncate']    = array(
    'Truncate Teaser',
    'Should the teaser be truncated after xx characters and be inserted as a content element? Enter 0 to deactivate this function.',
);

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_legend'] = 'RSS/Atom Feed (Import)';

// override corresponding text in tl_news_archive
$GLOBALS['TL_LANG']['tl_news_archive']['feed_legend'] = 'RSS/Atom Feed (Export)';

// References
$GLOBALS['TL_LANG']['tl_news_archive']['source']['default']  = 'Default';
$GLOBALS['TL_LANG']['tl_news_archive']['source']['external'] = 'External URL';
$GLOBALS['TL_LANG']['tl_news_archive']['source']['content']  = 'As content element';