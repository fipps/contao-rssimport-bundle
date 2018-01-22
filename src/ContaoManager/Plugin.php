<?php

/**
 * @copyright  Arne Borchert <http://www.fipps.de>
 * @author     Arne Borchert
 * @package    RSS-Import Bundle
 * @license    LGPL-3.0+
 *
 */

namespace Fipps\RssImportBundle\ContaoManager;

use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

/**
 * Plugin for the Contao Manager.
 *
 * @author Aren Borchert
 */
class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create('Fipps\RssImportBundle\FippsRssImportBundle')
                ->setLoadAfter(['Contao\CoreBundle\ContaoCoreBundle'])
                ->setReplace(['rssimport']),
        ];
    }
}