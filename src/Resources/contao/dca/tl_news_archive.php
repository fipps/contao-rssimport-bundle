<?php
/**
 * Contao RSS Import Bundle
 *
 * @copyright 2011, 2014, 2018 agentur fipps e.K.
 * @author    Arne Borchert
 * @package   fipps\contao-rssimport-bundle
 * @license   LGPL 3.0+
 */

// Load tl_content language file
$this->loadLanguageFile('tl_content');
$this->loadLanguageFile('tl_news');
$this->import('BackendUser', 'User');

// Table tl_news_archive
$GLOBALS['TL_DCA']['tl_news_archive']['config']['ondelete_callback'][] = array(
    'Fipps\RssimportBundle\RssImport',
    'deleteAttachments',
);

// Palettes
$GLOBALS['TL_DCA']['tl_news_archive']['palettes']['default'] = str_replace(
    '{protected_legend:hide}',
    '{rssimp_legend:hide},rssimp_imp; {protected_legend:hide}',
    $GLOBALS['TL_DCA']['tl_news_archive']['palettes']['default']
);

// Selectors
$GLOBALS['TL_DCA']['tl_news_archive']['palettes']['__selector__'][] = 'rssimp_imp';

// Subpalettes
$GLOBALS['TL_DCA']['tl_news_archive']['subpalettes']['rssimp_imp'] = 'rssimp_impurl, rssimp_imgpath, rssimp_size, rssimp_imagemargin, rssimp_fullsize, rssimp_floating, rssimp_published, rssimp_teaserhtml, rssimp_truncate, rssimp_allowedTags, rssimp_subtitlesrc, rssimp_author, rssimp_source, rssimp_target';

// Fields

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['rssimp_imp'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_imp'],
    'inputType' => 'checkbox',
    'exclude'   => true,
    'eval'      => array(
        'mandatory'      => false,
        'isBoolean'      => true,
        'submitOnChange' => true,
    ),
    'sql'       => "char(1) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['rssimp_impurl'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_impurl'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => array(
        'rgxp'           => 'url',
        'mandatory'      => true,
        'tl_class'       => 'long',
        'decodeEntities' => true,
    ),
    'sql'       => "varchar(255) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['rssimp_imgpath'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_imgpath'],
    'exclude'   => true,
    'inputType' => 'fileTree',
    'eval'      => array(
        'mandatory' => true,
        'fieldType' => 'radio',
        'path'      => 'files',
    ),
    'sql'       => "binary(16) NULL",
);

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['rssimp_size'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['size'],
    'exclude'   => true,
    'inputType' => 'imageSize',
    'options'   => $GLOBALS['TL_CROP'],
    'reference' => &$GLOBALS['TL_LANG']['MSC'],
    'eval'      => array(
        'rgxp'       => 'digit',
        'nospace'    => true,
        'helpwizard' => true,
        'tl_class'   => 'w50',
    ),
    'sql'       => "varchar(64) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['rssimp_imagemargin'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['imagemargin'],
    'exclude'   => true,
    'inputType' => 'trbl',
    'options'   => array('px', '%', 'em', 'rem', 'ex', 'pt', 'pc', 'in', 'cm', 'mm',),
    'eval'      => array(
        'includeBlankOption' => true,
        'tl_class'           => 'w50',
    ),
    'sql'       => "varchar(128) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['rssimp_fullsize'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['fullsize'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => array(
        'tl_class' => 'w50 m12',
    ),
    'sql'       => "char(1) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['rssimp_floating'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['floating'],
    'default'   => 'above',
    'exclude'   => true,
    'inputType' => 'radioTable',
    'options'   => array('above', 'left', 'right', 'below',),
    'eval'      => array(
        'cols'     => 4,
        'tl_class' => 'w50',
    ),
    'reference' => &$GLOBALS['TL_LANG']['MSC'],
    'sql'       => "varchar(12) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['rssimp_published'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_published'],
    'exclude'   => true,
    'filter'    => true,
    'flag'      => 1,
    'inputType' => 'checkbox',
    'eval'      => array(
        'doNotCopy' => true,
        'tl_class'  => 'long clr',
    ),
    'sql'       => "char(1) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['rssimp_subtitlesrc'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_subtitlesrc'],
    'sorting'   => true,
    'inputType' => 'select',
    'exclude'   => true,
    'options'   => array(
        'category'    => 'category (rss, atom)',
        'contributor' => 'contributor (atom)',
        'rights'      => 'rights (atom)',
    ),
    'eval'      => array(
        'mandatory'          => false,
        'tl_class'           => 'w50',
        'includeBlankOption' => true,
    ),
    'sql'       => "varchar(64) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['rssimp_teaserhtml'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_teaserhtml'],
    'exclude'   => true,
    'filter'    => true,
    'flag'      => 1,
    'inputType' => 'checkbox',
    'eval'      => array(
        'doNotCopy' => true,
        'tl_class'  => 'long',
    ),
    'sql'       => "varchar(1) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['rssimp_allowedTags'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_allowedTags'],
    'exclude'   => true,
    'inputType' => 'text',
    'default'   => &$GLOBALS['TL_CONFIG']['allowedTags'],
    'eval'      => array(
        'preserveTags' => true,
        'tl_class'     => 'clr',
        'mandatory'    => false,
        'tl_class'     => 'long',
    ),
    'sql'       => "text NOT NULL",
);

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['rssimp_author'] = array(
    'label'      => &$GLOBALS['TL_LANG']['tl_news']['author'],
    'default'    => $this->User->id,
    'exclude'    => true,
    'filter'     => true,
    'sorting'    => true,
    'flag'       => 11,
    'inputType'  => 'select',
    'foreignKey' => 'tl_user.name',
    'eval'       => array(
        'doNotCopy'          => true,
        'mandatory'          => true,
        'includeBlankOption' => true,
        'tl_class'           => 'w50',
    ),
    'sql'        => "int(10) unsigned NOT NULL default '0'",
    'relation'   => array(
        'type' => 'hasOne',
        'load' => 'eager',
    ),
);

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['rssimp_source'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_news']['source'],
    'default'   => 'external',
    'exclude'   => true,
    'filter'    => true,
    'inputType' => 'radio',
    'options'   => array(
        'default',
        'external',
        'content',
    ),
    'reference' => &$GLOBALS['TL_LANG']['tl_news_archive']['source'],
    'eval'      => array(
        'tl_class' => 'long, clr',
    ),
    'sql'       => "varchar(12) NOT NULL default 'external'",
);

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['rssimp_target'] = array(
    'label'     => &$GLOBALS['TL_LANG']['MSC']['target'],
    'default'   => '1',
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => array(
        'tl_class' => 'w50 m12',
    ),
    'sql'       => "char(1) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_news_archive']['fields']['rssimp_truncate'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_news_archive']['rssimp_truncate'],
    'inputType' => 'text',
    'exclude'   => true,
    'default'   => '0',
    'eval'      => array(
        'mandatory' => true,
        'rgxp'      => 'natural',
        'maxval'    => 9999,
    ),
    'sql'       => "varchar(4) NOT NULL default '0'",
);


