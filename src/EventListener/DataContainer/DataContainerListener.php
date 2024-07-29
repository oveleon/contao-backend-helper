<?php

declare(strict_types=1);

namespace Oveleon\ContaoBackendHelper\EventListener\DataContainer;

use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\StringUtil;
use Contao\User;
use Doctrine\DBAL\Connection;
use Symfony\Component\Security\Core\Security;

class DataContainerListener
{
    public function __construct(
        protected ContaoFramework $framework,
        protected Connection $connection,
        protected Security $security,
    ) {
    }

    /**
     * Adds the article backend info.
     */
    public function invokeArticleList($row, $label): string
    {
        // Execute the default function
        $strRow = (new \tl_article())->addIcon($row, $label);

        /** @var User $user */
        $user = $this->security->getUser();

        if (null === $user || 'none' === $user->article_info_style)
        {
            return $strRow;
        }

        $userPlaceholder = StringUtil::deserialize($user->article_info_placeholder, true);

        // Wrap content
        $strRow = '<span>'.$strRow.'</span>';

        // Extend article info
        if ((bool) $row['article_info'])
        {
            // Highlight info
            $hlInfo = html_entity_decode((string) $row['article_info']);
            $hlInfo = preg_replace(
                [
                    '/\{([^+]+)\}/iU',
                    '/\[([^+]+)\]/iU',
                    '/\#([^+]+)\#/iU',
                ],
                [
                    \in_array('class', $userPlaceholder, true) ? '<span class="bh-class">$1</span>' : '',
                    \in_array('tag', $userPlaceholder, true) ? '<span class="bh-tag">$1</span>' : '',
                    \in_array('id', $userPlaceholder, true) ? '<span class="bh-id">$1</span>' : '',
                ],
                $hlInfo,
            );

            $strRow .= '<span class="art-info" title="'.$row['article_info'].'">'.$hlInfo.'</span>';
        }

        return '<div class="tl_row_inner '.($user->article_info_style ?: '').'">'.$strRow.'</div>';
    }
}
