<?php

namespace Oveleon\ContaoBackendHelper\EventListener\DataContainer;

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\Database;
use Contao\DataContainer;
use Contao\Input;
use Contao\StringUtil;
use Contao\User;
use Doctrine\DBAL\Connection;
use Symfony\Component\Security\Core\Security;

class DataContainerListener
{
    public function __construct(
        protected ContaoFramework $framework,
        protected Connection $connection,
        protected Security $security
    ){}

    /**
     * Adds the article backend info
     */
    public function invokeArticleList($row, $label): string
    {
        // Execute the default function
        $strRow =  (new \tl_article())->addIcon($row, $label);

        /** @var User $user */
        $user = $this->security->getUser();

        if (null === $user || $user->article_info_style === 'none')
        {
            return $strRow;
        }

        // Wrap content
        $strRow  = '<span>' . $strRow . '</span>';

        // Extend article info
        if (!!$row['article_info'])
        {
            // Highlight info
            $hlInfo = html_entity_decode($row['article_info']);
            $hlInfo = preg_replace(
                [
                    '/\{([^+]+)\}/iU',
                    '/\[([^+]+)\]/iU',
                    '/\#([^+]+)\#/iU'
                ],
                [
                    '<span class="bh-class">$1</span>',
                    '<span class="bh-tag">$1</span>',
                    '<span class="bh-id">$1</span>'
                ],
                $hlInfo
            );

            $strRow .= '<span class="art-info" title="' . $row['article_info'] . '">' . $hlInfo . '</span>';
        }

        return '<div class="tl_row_inner ' . ($user->article_info_style ?: '') . '">' . $strRow . '</div>';
    }
}
