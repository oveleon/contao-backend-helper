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

        // Wrap content
        $strRow  = '<span>' . $strRow . '</span>';

        // Extend article info
        if(!!$row['article_info'])
        {
            $strRow .= '<span class="art-info" title="' . $row['article_info'] . '">' . $row['article_info'] . '</span>';
        }

        return '<div class="tl_row_inner ' . ($this->User->article_info_style ?: '') . '">' . $strRow . '</div>';
    }
}