<?php

namespace Oveleon\ContaoBackendHelper;

use Contao\Backend;
use Contao\BackendUser;

class BackendHelper extends Backend
{
    protected function __construct()
    {
        parent::__construct();
        $this->import(BackendUser::class, 'User');
    }

    public function invokeArticleList($row, $label)
    {
        // Execute the default function
        $strRow  = call_user_func_array(['tl_article', 'addIcon'], [$row, $label]);

        if(!$this->User->article_info_style === 'none')
        {
            return $strRow;
        }

        // Wrap content
        $strRow  = '<span>' . $strRow . '</span>';

        // Extend article info
        if(!!$row['article_info'])
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

        return '<div class="tl_row_inner ' . ($this->User->article_info_style ?: '') . '">' . $strRow . '</div>';
    }
}