<?php

/**
 * rssImport
 *
 * Language file for modules (de)
 *
 * Copyright (c) 2011, 2014 agentur fipps e.K
 *
 * @copyright 2011, 2014 agentur fipps e.K.
 * @author Arne Borchert
 * @package fipps\rssImport
 * @license LGPL
 */

// Fields
$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_imp'] = array(
        'Feed importieren',
        'RSS/Atom Feed Import aktivieren.'
);
$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_impurl'] = array(
        'Feed Url',
        'Geben Sie die URL für den Feed an, der importiert werden soll.'
);
$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_imgpath'] = array(
        'Pfad für Bilder/Anlagen',
        'Bitte wählen Sie den Ablagepfad für Bilder und Anlagen aus.'
);
$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_published'] = array(
        'Veröffentlichen',
        'Gelesene Beiträge automatisch zur Veröffentlichung freigeben'
);
$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_teaserhtml'] = array(
        'Erlaube HTML im Teaser',
        'HTML-Tags im Teaser erlauben.'
);
$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_subtitlesrc'] = array(
        'Feld für Untertitel',
        'Bestimme Feld für Untertitel in der RSS/Atom-Datei.'
);
$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_allowedTags'] = array(
        'Erlaubte HTML Tags',
        'Bestimmt welche Html-Tags im Beitrag erlaubt sind.'
);
$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_truncate'] = array(
        'Teaser abschneiden',
        'Soll der Teaser nach xx Zeichen abgeschitten werden und als Content-Element eingefügt werden? Geben Sie 0 ein zum Deaktivieren dieser Funktion.'
);


// Legends
$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_legend'] = 'RSS/Atom Feed (Import)';

// override corresponding text in tl_news_archive
$GLOBALS['TL_LANG']['tl_news_archive']['feed_legend'] = 'RSS/Atom Feed (Export)';

// References
$GLOBALS['TL_LANG']['tl_news_archive']['source']['default'] = 'Standard';
$GLOBALS['TL_LANG']['tl_news_archive']['source']['external'] = 'Externe URL';
$GLOBALS['TL_LANG']['tl_news_archive']['source']['content'] = 'Als Inhaltselement';