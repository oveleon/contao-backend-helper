<?php

declare(strict_types=1);

namespace Oveleon\ContaoBackendHelper\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Oveleon\ContaoBackendHelper\ContaoBackendHelper;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoBackendHelper::class)
                ->setReplace(['contao-backend-helper'])
                ->setLoadAfter([ContaoCoreBundle::class]
            ),
        ];
    }
}
